#!/bin/bash
host="$1"
port="$2"
shift 2
cmd="$@"

echo "Esperando a que MariaDB arranque en $host:$port..."
while ! nc -z "$host" "$port"; do
  sleep 1
done

echo "MariaDB está lista. Continuando..."
exec $cmd
