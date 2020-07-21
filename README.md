# findIngWeb
O projeto “findIngWeb”  filtrar nome(name) e local da internet (link) de uma em buscar na internet e devolve em forma de JSON.


### Projeto feito em HTML, CSS , JS e PHP.
Destinado a buscar palavras chaves em sites de busca e trazer o resultado em forma de lista com os nomes encontrados e os links para acesso do site.


### Instalação 
Basta extrair o projeto na pasta do seu servidor apache/php. Depois direcionar a busca de javascript (js/core.js) à url do seu servidor local;
Ex.: 
* http://localhost/findingweb - no caso do servidor Xampp e a pasta: C:/Xampp/htdocs/findingweb 


### Consumindo API
:: GET - acesse a url do servidor do projeto e acrescente /api/<palavra a buscar>
EX.:
* http://localhost/findingweb/api/casa - irá retornar todas as buscas com a palavra casa;
* http://localhost/findingweb/api/casa/20 - Para filtrar até vinte(20) resultados válidos da busca. Por padrão, se não for definido a quantidade,  ele irá retornar até dez(10) resultados válidos.
  
  
