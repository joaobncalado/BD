DROP TRIGGER IF EXISTS cnt_tr;
DROP TRIGGER IF EXISTS cnt_p;
DROP TRIGGER IF EXISTS cnt_c;
DROP TRIGGER IF EXISTS cnt_r;
DROP TRIGGER IF EXISTS cnt_v;

DELIMITER //
CREATE TRIGGER cont_tr BEFORE INSERT ON tipo_registo
FOR EACH ROW
	IF NEW.idseq IN (SELECT contador_sequencia FROM sequencia WHERE contador_sequencia=NEW.idseq) THEN
		INSERT INTO tipo_registo VALUES (NEW.userid, NEW.typecnt, NEW.nome, NEW.ativo, NEW.idseq, NEW.ptypecnt);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER cnt_p BEFORE INSERT ON pagina
FOR EACH ROW
	IF NEW.idseq IN (SELECT contador_sequencia FROM sequencia WHERE contador_sequencia=NEW.idseq) THEN
		INSERT INTO pagina VALUES (NEW.userid, NEW.pagecounter, NEW.nome, NEW.idseq, NEW.ativa, NEW.ppagecounter);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER cnt_c BEFORE INSERT ON campo
FOR EACH ROW
	IF NEW.idseq IN (SELECT contador_sequencia FROM sequencia WHERE contador_sequencia=NEW.idseq) THEN
		INSERT INTO campo VALUES (NEW.userid, NEW.typecnt, NEW.campocnt, NEW.idseq, NEW.ativo, NEW.nome, NEW.pcampocnt);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER cnt_r BEFORE INSERT ON registo
FOR EACH ROW
	IF NEW.idseq IN (SELECT contador_sequencia FROM sequencia WHERE contador_sequencia=NEW.idseq) THEN
		INSERT INTO registo VALUES (NEW.userid, NEW.typecounter, NEW.regcounter, NEW.nome, NEW.ativo, NEW.idseq, NEW.pregcounter);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER cnt_v BEFORE INSERT ON valor
FOR EACH ROW
	IF NEW.idseq IN (SELECT contador_sequencia FROM sequencia WHERE contador_sequencia=NEW.idseq) THEN
		INSERT INTO valor VALUES (NEW.userid, NEW.typeid, NEW.regid, NEW.campoid, NEW.valor, NEW.idseq, NEW.ativo, NEW.pcampoid);
	END IF;
END //
DELIMITER ;