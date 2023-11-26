#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>


WiFiClient wifiClient;

const char* ssid = "iPhone (Kacper)";
const char* password = "Kacper_To_Kozak";
const char* URL = "http://157.158.168.130/stacjaProject/temp_wilg/stacjaCode.php";

int temperature = 50;
int humidity =40;


void setup() {
    Serial.begin(115200);
    delay(10);

    // Połącz się z siecią Wi-Fi
    Serial.println();
    Serial.print("Łączenie z siecią ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Brak połączenia z WiFi...");
    }

    Serial.println("");
    Serial.println("Połączono z siecią Wi-Fi");
}

void loop() {
    String wyslaneDane = "temperature=" + String(temperature) + "&humidity=" + String(humidity);

    HTTPClient http;
    http.begin(wifiClient, URL);
    // Format wysylanych danych umozliwia przez serwer latwiejsza interpretacje.
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCode = http.POST(wyslaneDane);
    String odpowiedzSerwera = http.getString();
    Serial.print("URL : "); Serial.println(URL);
    Serial.print("Data : "); Serial.println(wyslaneDane);
    Serial.print("httpCode : "); Serial.println(httpCode);
    Serial.print("odpowidzSerwera : "); Serial.println(odpowiedzSerwera);
    Serial.print("-------------------------------------");
    if (httpCode > 0) {
        Serial.println("Dane zostały wysłane pomyślnie.");
    } else {
        Serial.println("Błąd podczas wysyłania danych.");
    }

    http.end();

    delay(6000); // Poczekaj 60 sekund przed wysłaniem kolejnych danych
}
