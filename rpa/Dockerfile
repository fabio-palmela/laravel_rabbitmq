# Dockerfile
FROM python:3.9
# FROM python:3.9-slim

ENV DOCKERIZE_VERSION v0.6.1

RUN apt-get update && \
    apt-get install -y wget && \
    wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz && \
    apt-get remove -y wget && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*
# RUN apt-get update && \
#     apt-get install -y ca-certificates

# Define o diretório de trabalho no contêiner
WORKDIR /app

# Copia o arquivo de requisitos para o contêiner
COPY requirements.txt .

# Instala as dependências
# RUN pip install --no-cache-dir -r requirements.txt
RUN pip install --no-cache-dir --trusted-host pypi.python.org --trusted-host pypi.org --trusted-host=files.pythonhosted.org -r requirements.txt

# Copia o código-fonte para o contêiner
COPY . .

# Comando padrão para executar o aplicativo
CMD ["dockerize", "-wait", "tcp://rabbitmq:5672", "--", "python", "RabbitMQConsumer.py"]
# CMD ["python", "RabbitMQConsumer.py"]
