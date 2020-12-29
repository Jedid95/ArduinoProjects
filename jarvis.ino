/* Project Jarvis 
   Begin in 21/12/2020
   Author: Jedid Santos
   Email: jedid.santos@gmail.com
*/

/* References
  Voice command: https://youtu.be/wI3z1rhAGPw
  Arduino Speak:
*/

/* Process 
  1. Load file: vr_sample_train to train microphone with your voice and record commands
  2. Load the saved commands into the microphone's flash memory
*/

#include <SoftwareSerial.h>
#include "VoiceRecognitionV3.h"

/*
 * Connection Arduino and Voice Module
 * Arduino      VoiceModule
 * 2 ----------  TX
 * 3 ----------  RX
 * Arduino pins can be changed as you wish
 */

 VR myVR(2,3); //pins arduino

uint8_t records[7]; // save record
uint8_t buf[64];

int led = 13;

//Recordings made in the training file
#define luzes    (0) 

/**
  @brief   Print signature, if the character is invisible, 
           print hexible value instead.
  @param   buf     --> command length
           len     --> number of parameters
*/
void printSignature(uint8_t *buf, int len){
  int i;
  for(i=0; i<len; i++){
    if(buf[i]>0x19 && buf[i]<0x7F){
      Serial.write(buf[i]);
    }
    else{
      Serial.print("[");
      Serial.print(buf[i], HEX);
      Serial.print("]");
    }
  }
}

/**
  @brief   Print signature, if the character is invisible, 
           print hexible value instead.
  @param   buf  -->  VR module return value when voice is recognized.
             buf[0]  -->  Group mode(FF: None Group, 0x8n: User, 0x0n:System
             buf[1]  -->  number of record which is recognized. 
             buf[2]  -->  Recognizer index(position) value of the recognized record.
             buf[3]  -->  Signature length
             buf[4]~buf[n] --> Signature
*/
void printVR(uint8_t *buf){
  Serial.println("VR Index\tGroup\tRecordNum\tSignature");

  Serial.print(buf[2], DEC);
  Serial.print("\t\t");

  if(buf[0] == 0xFF){
    Serial.print("NONE");
  }
  else if(buf[0]&0x80){
    Serial.print("UG ");
    Serial.print(buf[0]&(~0x80), DEC);
  }
  else{
    Serial.print("SG ");
    Serial.print(buf[0], DEC);
  }
  Serial.print("\t");

  Serial.print(buf[1], DEC);
  Serial.print("\t\t");
  if(buf[3]>0){
    printSignature(buf+4, buf[3]);
  }
  else{
    Serial.print("NONE");
  }
  Serial.println("\r\n");
}

/*
 @brief Detect the recorded word and perform the desired action
 */
void voiceDetected(){
  int ret;
  ret = myVR.recognize(buf, 50);
  if(ret>0){
    switch(buf[1]){
      case luzes:
        digitalWrite(led, digitalRead(led)^1);
        break;
      default:
        Serial.println("Record function undefined");
        break;
    }
    /** voice recognized */
    printVR(buf);
  }
}

void setup() {
  myVR.begin(9600);
  
  Serial.begin(115200);
  Serial.println("Jarvis Project - Automation through voice command");
  
  pinMode(led, OUTPUT);
    
  if(myVR.clear() == 0){
    Serial.println("Recognizer cleared.");
  }else{
    Serial.println("Not find VoiceRecognitionModule. | Please check connection and restart Arduino.");
    while(1);
  }
  
  if(myVR.load((uint8_t)luzes) >= 0){
    Serial.println("luzes loaded");
  }
}

void loop() {

  voiceDetected();

}
