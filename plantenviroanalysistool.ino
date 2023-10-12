#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include "DHT.h"
#define DHTPIN D4
#define DHTTYPE DHT11
#define SOILPIN A0
DHT dht(DHTPIN, DHTTYPE);

WiFiClient clientt;

const char *ssid = "WIFI SSID"; //Enter your WIFI ssid
const char *password = "WIFI PASS"; //Enter your WIFI password
ESP8266WebServer server(80);

const char *host = "HOST IP ADDRESS"; //host IP address
 
const int dry = 658; //value for soil moisture sensor when dry
const int wet = 283; //value for soil moisture sensor when wet

void setup() {
  Serial.begin(115200);
  pinMode(LED_BUILTIN, OUTPUT);     // Initialize the LED_BUILTIN pin as an output
  Serial.println("DHT Output: ");
  dht.begin();

  Serial.println();
  Serial.print("Configuring access point...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

// the loop function runs over and over again forever
void loop() {

  HTTPClient http;
  
  float temp = dht.readTemperature();
  float humidity = dht.readHumidity();
  float soilInt = analogRead(SOILPIN);
  float percentageSoil = map(soilInt, wet, dry, 100, 0);
  if(isnan(temp) || isnan(humidity)){
    Serial.println("Failed to read DHT11");
  }
  else{
    Serial.print("Humidity: ");
    Serial.print(humidity);
    Serial.print("%\t");
    Serial.print("Temperatures: ");
    Serial.print(temp);
    Serial.print(" *C ");
    Serial.print("Moisture: ");
    Serial.print(percentageSoil);
    Serial.print("%\t                 ");
    delay(5000);
  }

  String getData, link, tempStr, humStr, moistStr;

  tempStr = String(temp);
  humStr = String(humidity);
  moistStr = String(percentageSoil);
  
  getData = "?Temperature=" + tempStr + "&Humidity=" + humStr + "&Moisture=" + moistStr;
  link = "http://HOST IP ADDRESS/connect.php" + getData; //change HOST IP ADDRESS with IP address

  http.begin(clientt, link);
  //begin(WiFiClient, link);

  int httpCode = http.GET();
  String payload = http.getString();

  Serial.print(httpCode);
  Serial.print("    ");
  Serial.println(payload);

  http.end();
  
}
