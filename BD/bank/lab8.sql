/* 1 */

/* a) 

Escreva uma função em SQL que devolve o saldo absoluto de um cliente, isto é, a
diferença entre (1) todo o dinheiro que esse cliente tem em contas e (2) todas as
quantias que deve em empréstimos ao banco. A função deve ter um parâmetro
que identifica o cliente cujo saldo absoluto se pretende obter.

*/
drop function saldo_absoluto;
Delimiter //
create function saldo_absoluto (c_name varchar(255))
returns decimal (20,2)
begin
declare saldo decimal (20,2);
declare divida decimal (20,2);
select sum(balance) into saldo from account natural join depositor where customer_name=c_name;
select sum(amount) into divida from borrower natural join loan where customer_name=c_name;
return saldo-divida;
End //
Delimiter ;

/* b) 

Escreva uma função que devolve a diferença entre o saldo médio das contas em
duas agências dadas. A função tem dois parâmetros que identificam as agências a
comparar.

*/

drop function saldo_medio;
Delimiter //
create function saldo_medio (b1 varchar(255), b2 varchar(255))
returns decimal (20,2)
begin
declare balance1 decimal (20,2);
declare balance2 decimal (20,2);
select avg(balance) into balance1 from account where branch_name=b1;
select avg(balance) into balance2 from account where branch_name=b2;
return balance1-balance2;
End //
Delimiter ;

/* c) 

Usando a função desenvolvida na alínea anterior, escreva uma consulta que
permita determinar qual é a agência cujo saldo médio das contas é o maior entre
todas as agências.

*/

select b1.branch_name from branch b1, branch b2 group by b1.branch_name having min(saldo_medio(b1.branch_name, b2.branch_name))=0;

select b1.branch_name from branch b1, branch b2 group by b1.branch_name having max(saldo_medio(b1.branch_name, b2.branch_name))>=(select saldo_medio(b1.branch_name, b2.branch_name) from branch b1, branch b2 group by b1.branch_name);
