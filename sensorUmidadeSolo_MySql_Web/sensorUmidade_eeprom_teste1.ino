//    CONSTANTES DE CONEXAO
#include <ESP8266WiFi.h>
const char* ssid     = "Ramos1"; //nome da Rede na qual se está conectado
const char* password = "13021969"; //senha da Rede na qual se está conectado
const char* host = "10.0.10.211"; //host ao qual será enviado os dados (neste caso será o IP, servidor local, mas poderia ser o endereço de um site)

#define pinUmidade A0
#define pinVerde D5
#define pinAmarelo D6
#define pinVermelho D7
#define buzzer D4

//    LIMITES DE UMIDADE DO SOLO
#define MINIMO 15
#define MEDIO 25
#define MAXIMO 100

float sensor1; //SENSOR DE UMIDADE(HIGROMETRO);
float sensor2 = 0; //PRECIPITAÇÃO
float sensor3 = 0; //DESLOCAMENTO (TILTEMITER)

bool minimo = false;
bool medio = false;
bool maximo = false;

unsigned long tempo = 0;
const long intervalo = 10; // intervalo para cada leitura
const long duracao = 60; // tempo limite de execução cada intervalo

uint8_t valor_umidade;
uint8_t umidade;
uint8_t umid[(duracao/intervalo)];
int cont = 0;
int posicao = duracao/intervalo;

void showVariables() {
  // Exibe variaveis
  Serial.print("Umidade = "); Serial.println(umidade);
}
 
void setup() {
  Serial.begin(9600); //inicio da comunicação entre Arduino e PC -> velocidade: bits/segundo
  
  pinMode(pinUmidade, INPUT);
  pinMode(pinVerde, OUTPUT);
  pinMode(pinAmarelo, OUTPUT);
  pinMode(pinVermelho, OUTPUT);
  pinMode(buzzer, OUTPUT);

  delay(10);

  // INICIO DA CONEXAO COM O WIFI

  Serial.println(); //na tela Serial, ira apenas pular uma linha
  Serial.println();
  Serial.print("Conectando com "); //na tela Serial, ira imprimir a frase
  Serial.println(ssid); //na tela Serial, ira imprimir o nome da rede wifi

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado");
  Serial.println("Endereço IP: ");
  Serial.println(WiFi.localIP());
}

 
void loop() 
{
  tempo=tempo+1; 
  delay(1000);
  if(tempo <= duracao)
  {
    if(tempo % intervalo == 0)
    {
      valor_umidade = (100 - ((analogRead(pinUmidade) * 100) / 1024));
      Serial.print("valor umidade = "); Serial.print(valor_umidade);
      verificaNivelUmidade(valor_umidade);
      umid[cont] = valor_umidade;
      cont++;

        // =========================================== NORMALIDADE =================================================
  
        if(minimo){
          Serial.print(" -- Nivel Seguro\n");
          digitalWrite(pinVerde, HIGH);
          digitalWrite(pinAmarelo, LOW);
          digitalWrite(pinVermelho, LOW);
        }
    
        // =========================================== ATENCAO =====================================================
        if(medio){
          Serial.print(" -- Nivel Moderado\n");
          digitalWrite(pinVerde, LOW);
          digitalWrite(pinAmarelo, HIGH);
          digitalWrite(pinVermelho, LOW);
    
          tone(buzzer,500);  
          delay(1000); //Em delay esperamos um segundo para avançar para a próxima linha
          noTone(buzzer); //Desligamos o Buzzer
          delay(1000);
        }
    
        // =========================================== PERIGO ======================================================
        if(maximo)
        {
          Serial.print(" -- Nivel Critico\n");
          digitalWrite(pinVerde, LOW);
          digitalWrite(pinAmarelo, LOW);
          digitalWrite(pinVermelho, HIGH);
      
          tone(buzzer,1500);  
          delay(1000); //Em delay esperamos um segundo para avançar para a próxima linha
          noTone(buzzer); //Desligamos o Buzzer
          delay(1000);
       }
    }
  }
  if(tempo == duracao) // SALVA NA PAGINA WEB
  {
    Serial.print("\nChegou ao final de um ciclo, de: ");
    Serial.print(duracao);
    Serial.print("segundos \n\n");
    Serial.print("--- Dados da EEPROM\n");

    //SALVAR NA PAGINA WEB

      for(cont = 0; cont < posicao; cont++)
      {
       //=========================================================================================
       //                         ESPAÇO RESERVADO PARA LEITURA DOS SENSORES

          sensor1 = umid[cont];
          sensor2+=0;
          sensor3+=0;

          umidade  = umid[cont]; //COMENTAR ESTA PARTE, NO CASO DO SUCESSO
          showVariables(); //COMENTAR
      //=========================================================================================

          Serial.print("Conectando com ");
          Serial.println(host); //endereço de IP do computador
        
          // USO DA CLASSE WiFiClient PRA CRIAR A CONEXAO TCP
          WiFiClient client;
          const int httpPort = 80; //porta com a qual haverá conexao. Se for um servidor local com uma porta diferente
          if (!client.connect(host, httpPort)) { //tenta conexao, se não for possivel conecta novamente
            Serial.println("Falha na Conexao");
            return;
          }

          //CRIAÇÃO DE UMA URI() PARA A REQUISIÇÃO
          // URI: padrao para identificacao de documentos com uma curta sequencia de numero, letras e simbolos
          String url = "/sistemaLogin/salvardados.php?"; //php que receberá os valores lidos
                  url += "sensor1=";
                  url += sensor1;
                  url += "&sensor2=";
                  url += sensor2;
                  url += "&sensor3=";
                  url += sensor3;
  
          Serial.print("Requesitando URL: ");
          Serial.println(url);
        
          //SERÁ ENVIADO UMA REQUISIÇÃO PARA O SERVIDOR
          client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                       "Host: " + host + "\r\n" + //host definido acima, IP local
                       "Connection: close\r\n\r\n"); //finaliza a conexao
      
          // VERIFICA O TEMPO DA SOLICITAÇÃO FEITA, O QUANTO A SOLICITAÇÃO DEMORA, PARA EVITAR QUE TRAVE O MICROCONTROLADOR
          unsigned long timeout = millis(); 
          while (client.available() == 0) {
            if (millis() - timeout > 5000) {
              Serial.println(">>> Client Timeout !");
              client.stop();
              return;
            }
          }
        
          // CAPTURA O QUE RETORNOU DO SERVIDOR
          while (client.available()) {
            String line = client.readStringUntil('\r');
          }
      }

    //APAGAR OS DADOS ATUAIS DA EEPROM

      for(cont = 0; cont < posicao; cont++)
      {
        umid[cont] = 0;
      }
   
      tempo = 0;
      cont = 0;
  }

  minimo = false;
  medio = false;
  maximo = false;
}

void verificaNivelUmidade(int valor_umidade){
  //Nivel Seguro
  if (valor_umidade >= 0 && valor_umidade <= MINIMO) {
    minimo = true; 
  } 
  //Nivel Moderado
  if (valor_umidade> MINIMO && valor_umidade <= MEDIO) {
    medio = true;
  }
  //Nivel Critico         
  if (valor_umidade > MEDIO && valor_umidade <= MAXIMO) {
    maximo = true;
  }
}
