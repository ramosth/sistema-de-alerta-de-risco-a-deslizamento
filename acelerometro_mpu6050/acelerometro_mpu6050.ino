#include <Wire.h>
 
//Direção I2C da IMU
#define MPU 0x68

//LEDS
#define pinVerde D5
#define pinAmarelo D6
#define pinVermelho D7
#define pinAzul D8

//MPU-6050 da os valores em inteiros de 16 bits
//Valores RAW
// Leitura dos valores fornecidos diretamente pelo MPU-6050 (valores RAW) através do barramento I2C. 
//Os valores RAW têm um intervalo de medição entre -32768 e +32767.

int16_t AcX, AcY, AcZ, GyX, GyY, GyZ, Tmp;

void setup()
{
Wire.begin(4,5); // D2(GPIO4)=SDA / D1(GPIO5)=SCL
Wire.beginTransmission(MPU); // iniciando o sensor
Wire.write(0x6B); // endereço I2C
Wire.write(0);
Wire.endTransmission(true); // iniciando I2C
Serial.begin(115200); // iniciando a porta serial
}

void loop()
{
   Wire.beginTransmission(MPU); //iniciando a transmissao
   Wire.write(0x3B); //definindo o registrador que será utilizado
   Wire.endTransmission(false);

   //Solicita os 6 dados do sensor
   Wire.requestFrom(MPU,7*2,true); //Cada valor ocupa 2 registros

   //Armazenado os valores lido pelo NodeMCU

   //Aceleração do eixo X,Y e Z
   AcX=Wire.read()<<8|Wire.read(); 
   AcY=Wire.read()<<8|Wire.read();
   AcZ=Wire.read()<<8|Wire.read();
   Tmp=Wire.read()<<8|Wire.read();
   GyX=Wire.read()<<8|Wire.read();
   GyY=Wire.read()<<8|Wire.read();
   GyZ=Wire.read()<<8|Wire.read();

  //Conversão para Sistema Internacional
   float ax_m_s2 = AcX * (9.81/16384.0);
   float ay_m_s2 = AcY * (9.81/16384.0);
   float az_m_s2 = AcZ * (9.81/16384.0);
   float temp_grau_celcius = Tmp/340.00+36.53;
   float gx_deg_s = GyX * (250.0/32768.0);
   float gy_deg_s = GyY * (250.0/32768.0);
   float gz_deg_s = GyZ * (250.0/32768.0);

    //Calculo dos angulos de inclinação
    float accel_ang_x=atan(AcX/sqrt(pow(AcY,2) + pow(AcZ,2)))*(180.0/3.14);
    float accel_ang_y=atan(AcY/sqrt(pow(AcX,2) + pow(AcZ,2)))*(180.0/3.14);
    
   //Imprime os valores na serial
   Serial.println("Acelerometro(m/s2) \t\tGiroscópio(deg/s) \t\tTemperatura(ºC)"); 
   Serial.print(" X = "); Serial.print(ax_m_s2);
   Serial.print("\t\t\t X = "); Serial.print(gx_deg_s);
   Serial.print("\t\t\t Temp = "); Serial.println(temp_grau_celcius);
   Serial.print(" Y = "); Serial.print(ay_m_s2);
   Serial.print("\t\t\t Y = "); Serial.println(gy_deg_s);
   Serial.print(" Z = "); Serial.print(az_m_s2);
   Serial.print("\t\t\t Z = "); Serial.println(gz_deg_s);

   Serial.print("\nInclinação em X: ");
   Serial.print(accel_ang_x); 
   Serial.print("\t\tInclinação em Y:");
   Serial.println(accel_ang_y);
   Serial.println();

   if (AcX < 1000 && AcY < -8000)
   {
      digitalWrite(pinVerde, HIGH);
      digitalWrite(pinAzul, LOW);
      digitalWrite(pinVermelho, LOW);
      digitalWrite(pinAmarelo, LOW);
   }
   else if (AcX < 1000 && AcY > 8000)
   {
      digitalWrite(pinVerde, LOW);
      digitalWrite(pinAzul, HIGH);
      digitalWrite(pinVermelho, LOW);
      digitalWrite(pinAmarelo, LOW);
   }
   else if (AcX > 8000 && AcY < 1000)
   {
      digitalWrite(pinVerde, LOW);
      digitalWrite(pinAzul, LOW);
      digitalWrite(pinVermelho, HIGH);
      digitalWrite(pinAmarelo, LOW);
   }
   else if (AcX < -8000 && AcY < 1000)
   {
      digitalWrite(pinVerde, LOW);
      digitalWrite(pinAzul, LOW);
      digitalWrite(pinVermelho, LOW);
      digitalWrite(pinAmarelo, HIGH);
   }
   else
   {
      digitalWrite(pinVerde, LOW);
      digitalWrite(pinAzul, LOW);
      digitalWrite(pinVermelho, LOW);
      digitalWrite(pinAmarelo, LOW);
   }
   
   
   delay(1000); //aguarda 1000ms para ler novamente os valores
}
