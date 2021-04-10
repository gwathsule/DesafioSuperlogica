# Desafio superlógica

Abaixo segue as respostas das questões do desafio:

## Questão 1

Foi criado um mini projeto com a descrição da questão 1.
Não utilizei a função `curl($url, $informacao): array|json` pois não encontrei uma utilização para ela.

* A função `select($informacao): boolean` está sendo utilizada [nesse serviço](https://github.com/gwathsule/DesafioSuperlogica/blob/master/app/Services/SelectService.php) e os testes [nessa classe](https://github.com/gwathsule/DesafioSuperlogica/blob/master/tests/SelectTest.php);
* A função `insert(): boolean` está sendo utilizada [nesse serviço](https://github.com/gwathsule/DesafioSuperlogica/blob/master/app/Services/InsertService.php) e os testes [nessa classe](https://github.com/gwathsule/DesafioSuperlogica/blob/master/tests/InsertTest.php);

para realizar o deploy é necessário ter instalado no seu local o [docker](https://www.docker.com/get-started) e o [docker-compose](https://docs.docker.com/compose/install/) e seguir os seguintes passos:
> 1. dar permissão de execução ao arquivo bin na raiz do projeto

```bash
$ chmod u+x bin 
```

> 2. Iniciar o servidor php + web server nginx

```bash
$ ./bin up -d
```

Caso queira rodar os testes, execute o comando
```bash
$ ./bin phpunit
```

Para derrubar o servidor, execute o comando
```bash
$ ./bin down
```

## Questão 2
o seguinte código foi utilizado para realizar as operações com o array os testes utilizados para essa questão se encontra [nessa pasta](https://github.com/gwathsule/DesafioSuperlogica/blob/master/tests/ArrayTest.php) do projeto

```php
<?
//1) Crie um array
$numbers = [];

//2) Popule este array com 7 números
$numbers[] = 2;
$numbers[] = 9;
$numbers[] = 7;
$numbers[] = 0;
$numbers[] = 8;
$numbers[] = 2;
$numbers[] = 4;
//3) Imprima o número da posição 3 do array
$third = $numbers[2];
echo $third;

//4) Crie uma variável com todas as posições do array no formato de string separado por vírgula
$stringNumbers = implode(',', $numbers);

//5) Crie um novo array a partir da variável no formato de string que foi criada
$newArray = array_map('intval', explode(',', $stringNumbers));

//6) Crie uma condição para verificar se existe o valor 14 no array
if(in_array(14, $numbers));

//7) Faça uma busca em cada posição. Se o número da posição atual for menor que aposição anterior,
//   exclua esta posição
$reducedArray = $numbers;
for($i=1; $i<count($numbers); $i++) {
    if($numbers[$i] < $numbers[$i-1]) {
        unset($reducedArray[$i]);
    }
}

//8) Remova a última posição deste array
$reducedArray = $numbers;
array_pop($reducedArray);

//9) Conte quantos elementos tem neste array
count($numbers);

//10) Inverta as posições deste array 2,9,7,0,8,2,4
$inverseArray = array_reverse($numbers);
```

## Questão 3
O DML utilizado para gerar o resultado proposto foi o seguinte:

```sql
SELECT
    concat(Usuario.nome  ,' - ', Info.genero) as usuario,
    IF((YEAR(NOW()) - Info.ano_nascimento) > 50, 'SIM', 'NAO') as  maior_50_anos
FROM Usuario
	INNER JOIN Info 
	ON Usuario.cpf = Info.cpf
WHERE Info.genero = 'M' and  Usuario.id < 5
ORDER BY Usuario.cpf
```
