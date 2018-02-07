INSERT INTO utilizador (userid, email, nome, password, questao1, resposta1, pais, categoria) VALUES
(1, 'jose@gmail', 'jose', 'cccc', 'blabla', 'hahdha', 'pt', 'hauid'),
(2, 'joao@gmail', 'joao', 'cccc', 'blabla', 'hahdha', 'pt', 'hauid'),
(3, 'felix@gmail', 'felix','cccc', 'blabla', 'hahdha', 'pt', 'hauid'),
(4, 'vanessa@gmail', 'vanessa', 'cccc', 'blabla', 'hahdha', 'pt', 'hauid');

INSERT INTO login (contador_login, userid, sucesso, moment) VALUES 
(1, 2, 0, '2008-11-11 13:23:44'),
(2, 2, 0, '2008-11-11 13:23:44'),
(3, 2, 0, '2008-11-11 13:23:44'),
(4, 2, 1, '2008-11-11 13:23:44'),
(5, 3, 1, '2008-11-11 13:23:44'),
(6, 3, 0, '2008-11-11 13:23:44'),
(7, 3, 1, '2008-11-11 13:23:44');

INSERT INTO sequencia (contador_sequencia, moment, userid) VALUES
(1, '2008-11-11 13:23:44', 1),
(2, '2008-11-11 13:23:44', 2),
(3, '2008-11-11 13:23:44', 3),
(4, '2008-11-11 13:23:44', 4);


/*INSERT INTO registo (userid, typecounter, regcounter, nome, ativo, idseq, pregcounter) VALUES
(2, 1, 1, 'reg1');
(2, 2, 2, 'reg2'),
(2, 3, 3, 'reg3'),
(3, 4, 4, 'reg4'),
(3, 5, 5, 'reg5'),
(3, 6, 6, 'reg6'),
(3, 7, 7, 'reg7'),
(4, 8, 8, 'reg8'),
(4, 9, 9, 'reg9');*/

/*
INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa, ppagecounter) VALUES

(2, 1, 'pag21', 1, 1),
(2, 2, 'pag22', 1, 1),
(2, 3, 'pag23', 1, 1),
(3, 4, 'pag31', 1, 1),
(4, 5, 'pag41', 1, 1),
(4, 6, 'pag42', 1, 1),
(4, 7, 'pag43', 1, 1),
(4, 8, 'pag44', 1, 1);

INSERT INTO reg_pag (idregpag, userid, pageid, typeid, regid, idseq, ativa, pidregpag) VALUES
(1, 2, 1, 1, 1, 2, 1);*/