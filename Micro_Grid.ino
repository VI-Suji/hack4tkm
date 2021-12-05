/*
 SMS sender

 This sketch, for the Arduino GSM shield,sends an SMS message
 you enter in the serial monitor. Connect your Arduino with the
 GSM shield and SIM card, open the serial monitor, and wait for
 the "READY" message to appear in the monitor. Next, type a
 message to send and press "return". Make sure the serial
 monitor is set to send a newline when you press return.

 Circuit:
 * GSM shield
 * SIM card that can send SMS

 created 25 Feb 2012
 by Tom Igoe

 This example is in the public domain.

 http://www.arduino.cc/en/Tutorial/GSMExamplesSendSMS

 */

// Include the GSM library
#include <GSM.h>

#define PINNUMBER ""

// initialize the library instance
GSM gsmAccess;
GSM_SMS sms;

int msg[20]; //char array to store message
int trigger = 0; //Trigger varible used to switch between listen and send mode

void setup() {
  pinMode(12, INPUT); //Input signal from the PLC Demodulator
  pinMode(11, INPUT); //If enabled, the System enters setup mode
  // initialize serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

  Serial.println("Electric Pole Micro Grid");

  // connection state
  boolean notConnected = true;

  // Start GSM shield
  // If your SIM has PIN, pass it as a parameter of begin() in quotes
  while (notConnected) {
    if (gsmAccess.begin(PINNUMBER) == GSM_READY) {
      notConnected = false;
    } else {
      Serial.println("Not connected");
      delay(1000);
    }
  }

  Serial.println("GSM initialized");
}

void Listen()  //Function listens signals from PLC and saves them onto a char array
{
  for(int i =0; i<20; i++)
  {
    if(digitalRead(12)==HIGH)
    msg[i] = 1;
    else
    {
    msg[i] =0;}
    delay(100);
  }
  trigger = 1;
}

void loop() {

  int remoteNum[20];  // SIM number of the Main Grid Station to send sms
  if(digitalRead(11)==HIGH); //System enters setup mode
  {
    Serial.println("Type in the 10 digit Main Grid Section ID");
    for(int i=0;i<20;i++)
    {remoteNum[i] = Serial.read();
    Serial.println(remoteNum[i]);}
    byte address = 01001100; //A preset Address is set to each MicroGrid station, the address is hard coded into the device
    //The address byte is a 8 bit, which means there can be 256 Micro Grid Sections under each Main Grid Section
  }

  do{
    Listen(); //device listens for incoming messages, once a message is recieved the trigger is set to 1; 
  }
  while(trigger==0);

  if(trigger ==1) //Once the trigger is pulled to 1, the message sending process starts
  {Serial.println("SENDING");}

  // send the message
  
  sms.beginSMS(remoteNum);
  sms.print(msg);
  sms.endSMS();
  Serial.println("\nCOMPLETE!\n");
}
