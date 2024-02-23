import pika
from google_locators import GoogleSearch

class RabbitMQConsumer:
    # def __init__(self, exchange_name='credito', queue_name='rpa', routing_key='simulacao.calcular.*', rabbitmq_host='rabbitmq'):
    def __init__(self, exchange_name='credito', queue_name='rpa', routing_key='simulacao.calcular.*', rabbitmq_host='127.0.0.1'):
        self.exchange_name = exchange_name
        self.queue_name = queue_name
        self.routing_key = routing_key
        self.rabbitmq_host = rabbitmq_host

    def callback(self, ch, method, properties, body):
        print(f"Recebido: {body}")
        googleSearchObj = GoogleSearch()
        googleSearchObj.search()

    def start_consuming(self):
        connection = pika.BlockingConnection(pika.ConnectionParameters(self.rabbitmq_host))
        channel = connection.channel()

        # Declare a topic exchange
        try:
            channel.exchange_declare(exchange=self.exchange_name, exchange_type='topic', durable=True)
        except pika.exceptions.ChannelClosedByBroker as e:
            if e.args[0] == 406:
                print(f"Exchange '{self.exchange_name}' already exists.")
            else:
                raise

        # Declare a queue
        channel.queue_declare(queue=self.queue_name)

        # Bind the queue to the exchange with routing key
        channel.queue_bind(exchange=self.exchange_name, queue=self.queue_name, routing_key=self.routing_key)

        channel.basic_consume(queue=self.queue_name, on_message_callback=self.callback, auto_ack=True)

        print(f'Aguardando mensagens na fila "{self.queue_name}" na exchange "{self.exchange_name}" com routing key "{self.routing_key}". Para sair, pressione CTRL+C')
        channel.start_consuming()

if __name__ == "__main__":
    consumer = RabbitMQConsumer()

    consumer.start_consuming()
