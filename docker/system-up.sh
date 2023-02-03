
BASEDIR=${PWD}/$(dirname "$0")
book.api
echo "--------- CRIANDO NETWORK ----------"
sudo docker network create --subnet 174.30.0.0/16 book_net

sudo docker rm -f book.api
sudo docker rm -f book.db

echo "--------- BUILDANDO A IMAGEM ----------"
sudo docker build -t book-api ${BASEDIR}


echo "--------- CRIANDO CONTAINER ----------"
sudo docker run --name book.api -idt --net book_net --ip=174.30.0.2 -v ${BASEDIR}/..:/var/www/html book-api
sudo docker run --name book.db -idt --net book_net --ip=174.30.0.3 -e POSTGRES_PASSWORD=admin -e PGDATA=/var/lib/postgresql/data/pgbook -v ${BASEDIR}/../../db:/var/lib/postgresql/data postgres
echo "--------- CRIANDO HOSTS ----------"
if grep "174.30.0.2" /etc/hosts> /dev/null
then
    echo "--------- HOST JÁ EXISTE ----------"
    echo "--------- ATUALIZANDO PROJETO ----------"
    sudo docker exec book.api composer install
    sudo docker exec book.api php artisan migrate
    echo "LINK:  http://book.api"
    exit
fi
echo "--------- HOST CRIADA ----------"
sudo echo "174.30.0.2 book.api" | sudo tee -a /etc/hosts
echo "--------- ATUALIZANDO PROJETO ----------"
sudo docker exec book.api composer install
sudo docker exec book.api php artisan migrate
echo "LINK:  http://book.api"