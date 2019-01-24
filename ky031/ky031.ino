/*
Arduino     Knock/Shock Sensor KY-031
 GND               -
 3.3V               +5V
 D3                S
*/

int Led = D7;// LED pin
int Shock = D3;
int val;

void setup () {
 Serial.begin(9600);
 pinMode(Led, OUTPUT);
 pinMode(Shock, INPUT);
}

void loop () {
 val = digitalRead (Shock);
 
 if (val == HIGH) {// diante de uma batida (shock) o led se acende, e permanece acesso por 0.5s.
  digitalWrite(Led, LOW);
 }
 else {
  digitalWrite(Led, HIGH);
  Serial.println("Batida detectada"); //IMPRIME O TEXTO NA SERIAL
  
 }
}
