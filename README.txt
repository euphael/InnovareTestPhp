O questionário traz instruções de pulo para o entrevistador dependendo das respostas recebidas. Por exemplo, se na pergunta 1 uma pessoa diz não ter celular, o entrevistador deve pular para a pergunta 7, porque não faz sentido aplicar as perguntas 2 a 6 para pessoas que não tenham celular.

As respostas das entrevistas foram registradas em um banco de dados, e agora é necessário consistir os dados para detectar possíveis erros no preenchimento de algum questionário.

 

No arquivo SQL anexado, está a tabela questionario, que contém os dados das entrevistas obtidas (estrutura de colunas + conteúdo).O código em PHP que percorre todos os questionários e imprima na tela qualquer problema encontrado.


Exemplo de um problema: uma pessoa que não tem telefone celular (v1=2) respondeu a pergunta 2. Ou então, o contrário: uma pessoa que tem celular não respondeu a pergunta 2. Na tela, deve aparecer o ID do questionário e o problema encontrado. Além de verificações desse tipo (se os pulos do questionário foram seguidos), também, verificações de respostas que estão devidamente preenchidas de acordo com os pulos, mas que não façam sentido.

INSTALAR XAMPP + INSTALAR MYSQLWORKBENCH + INSTALAR PHP V-8.2.12 + INSTALAR DEPENDENCIAS DENTRO DO PHP
