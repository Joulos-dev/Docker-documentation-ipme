#!/bin/bash
mkdir -p certs
chmod 777 certs
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 \
  -keyout certs/localhost.key -out certs/localhost.crt \
  -subj "/C=FR/ST=Dev/L=Local/O=Localhost/CN=localhost"
echo "✅ Certificats générés dans /certs"
