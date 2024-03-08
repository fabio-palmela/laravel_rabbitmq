import pika
import json
import time

# Configurações de conexão com o RabbitMQ
connection_params = pika.ConnectionParameters('localhost')
connection = pika.BlockingConnection(connection_params)
channel = connection.channel()

# Declaração da troca (exchange)
# channel.exchange_declare(exchange='credito', exchange_type='topic')
channel.exchange_declare(exchange='credito', exchange_type='topic', durable=True)


# Dados para enviar
dados = {
    'message': 'dell',
    'valor_credito': 45,
    'cpf_cooperado': '05907569662',
    'num_simulacoes': 1
}

# Converte os dados para formato JSON
mensagem_json = json.dumps(dados)

# Número de vezes a enviar a mensagem por segundo
quantidade_envios_por_segundo = 100

# Loop para enviar a mensagem várias vezes por segundo
while True:
    for _ in range(quantidade_envios_por_segundo):
        # Publica a mensagem na troca "credito" com a bind key "simular.consignado.calcular"
        channel.basic_publish(exchange='credito', routing_key='simular.consignado.calcular', body=mensagem_json)

    print(f'{quantidade_envios_por_segundo} mensagens enviadas por segundo: {mensagem_json}')
    time.sleep(1)
