-- Scripr de criação do modelo fisico do Banco de Dados do Projeto integrado BES-- .
-- drop database projetoCG; 
create database projetoCG;
use projetoCG;

create table TBTema(
	IDTema int primary key,
    Nome varchar(200),
    Descricao varchar(500)
);

create table TBCurso(
	IDCurso int primary key,
    Nome varchar(200),
    Duracao_meses int,
    Descricao varchar(500),
    Nivel enum("Iniciante", "Intermediario", "Avançado")
);

create table TBModulo(
	IDModulo int primary key,
    Nome varchar(200),
    Descricao varchar(500),
    IDCurso int,
    IDTema int,
    foreign key (IDTema) references TBTema(IDTema),
    foreign key (IDCurso) references TBCurso(IDCurso)
);

create table TBMateria(
	IDMateria int primary key,
    Nome varchar(200),
    Descricao varchar(500),
    Horas_semanais float
);

create table TBModuloM_Materia(
	IDModulo int,
    IDMateria int,
    primary key (IDModulo, IDMateria),
    foreign key (IDModulo) references TBModulo(IDModulo),
    foreign key (IDMateria) references TBMateria(IDMateria)
);

create table TBTurma(
	IDTurma int primary key,
    Nome varchar(200),
    Horario time,
    IDCurso int,
    Modalidade enum("Presencial", "Remoto"),
    foreign key (IDCurso) references TBCurso(IDCurso)
);

Create table TBTurma_Materia(

	IDTurma int,
    IDMateria int,
    primary key (IDTurma, IDMateria),
    foreign key (IDTurma) references TBTurma(IDTurma),
    foreign key (IDMateria) references TBMateria(IDMateria)
);

Create table TBGrauInstrucao(
	IDGrau int primary key,
    Nome varchar(50)
);

Create table TBProfessor(
	IDProfessor int primary key,
    Nome varchar(200),
    IDGrau int,
    foreign key (IDGrau) references TBGrauInstrucao(IDGrau)
);

Create table TBProfessorMateria(
	IDMateria int,
    IDProfessor int,
    primary key (IDMateria, IDProfessor),
    foreign key (IDMateria) references TBMateria(IDMateria),
    foreign key (IDProfessor) references TBProfessor(IDProfessor)
);

Create Table TBResponsavel(
	IDResponsavel int primary key,
    Nome varchar(200),
    CPF char(11)
);

create table TBAluno(
	Matricula int primary key,
    Nome varchar(200),
    data_nasc date,
    CPF char(11),
    IDResponsavel int,
    IDTurma int,
    usuario varchar(10) Null,
    foreign Key (IDTurma) references TBTurma(IDTurma),
    foreign key (IDResponsavel) references TBResponsavel(IDResponsavel)
);

create table TBAvaliacao(
	IDAvaliacao int Primary key,
    Conteudo varchar(200),
    IDMateria int,
    foreign key (IDMateria) references TBMateria(IDMateria)
);

create table TBAluno_Avaliacao(
	Matricula int,
    IDAvaliacao int,
    Nota float,
    primary key (Matricula, IDAvaliacao),
    foreign key (Matricula) references TBAluno(Matricula),
    foreign key (IDAvaliacao) references TBAvaliacao(IDAvaliacao)
);

-- Populando O DB projetoCG
use projetoCG;


-- Inserções para a tabela TBTema
INSERT INTO TBTema (IDTema, Nome, Descricao) VALUES
	(1, 'Introdução à Programação', 'Fundamentos básicos de programação'),
	(2, 'Estruturas de Dados', 'Manipulação de estruturas de dados em programação'),
	(3, 'Desenvolvimento Web', 'Construção de aplicações web'),
	(4, 'Banco de Dados', 'Gerenciamento de dados e SQL'),
	(5, 'Programação Orientada a Objetos', 'Princípios de POO'),
	(6, 'Desenvolvimento Mobile', 'Criação de aplicativos para dispositivos móveis'),
	(7, 'Inteligência Artificial', 'Conceitos básicos de IA'),
	(8, 'Segurança da Informação', 'Proteção de dados e sistemas'),
	(9, 'Desenvolvimento Ágil', 'Metodologias ágeis de desenvolvimento de software'),
	(10, 'Projeto Final', 'Implementação de um projeto prático');

-- Inserções para a tabela TBCurso
INSERT INTO TBCurso (IDCurso, Nome, Duracao_meses, Descricao, Nivel) VALUES
	(1, 'Curso de Desenvolvimento Front-end', 6, 'Construção de interfaces web interativas', 'Iniciante'),
	(2, 'Curso de Desenvolvimento Back-end', 6, 'Desenvolvimento de lógica e servidores', 'Iniciante'),
	(3, 'Curso Full Stack', 12, 'Domínio tanto de Front-end quanto de Back-end', 'Intermediario'),
	(4, 'Curso de Banco de Dados', 4, 'Manipulação e gerenciamento de bancos de dados', 'Iniciante'),
	(5, 'Curso de Mobile App Development', 8, 'Desenvolvimento de aplicativos para dispositivos móveis', 'Intermediario'),
	(6, 'Curso de Inteligência Artificial', 10, 'Aplicações práticas de IA', 'Avançado'),
	(7, 'Curso de Segurança da Informação', 6, 'Proteção de dados e sistemas', 'Intermediario'),
	(8, 'Curso de Desenvolvimento Ágil', 6, 'Metodologias ágeis e práticas de desenvolvimento', 'Avançado');


-- Inserções para a tabela TBModulo
INSERT INTO TBModulo (IDModulo, Nome, Descricao, IDCurso, IDTema) VALUES
(1, 'Fundamentos do HTML e CSS', 'Conceitos básicos de marcação e estilo web', 1, 1),
(2, 'JavaScript Avançado', 'Manipulação avançada de elementos na página', 1, 2),
(3, 'Node.js e Express', 'Desenvolvimento de servidores com Node.js e Express', 2, 2),
(4, 'React.js', 'Construção de interfaces web reativas', 3, 1),
(5, 'Angular', 'Framework para desenvolvimento web', 3, 1),
(6, 'Banco de Dados Relacional', 'Princípios de bancos de dados relacionais', 4, 4),
(7, 'MongoDB', 'Banco de dados NoSQL', 4, 4),
(8, 'Desenvolvimento Android', 'Construção de aplicativos para Android', 5, 6),
(9, 'Desenvolvimento iOS', 'Construção de aplicativos para iOS', 5, 6),
(10, 'Machine Learning Básico', 'Introdução aos conceitos de Machine Learning', 6, 7);

-- Inserções para a tabela TBMateria
INSERT INTO TBMateria (IDMateria, Nome, Descricao, Horas_semanais) VALUES
(1, 'HTML e CSS', 'Conceitos e práticas de HTML e CSS', 4.5),
(2, 'JavaScript', 'Programação client-side com JavaScript', 3.0),
(3, 'Node.js', 'Desenvolvimento server-side com Node.js', 5.5),
(4, 'React.js', 'Desenvolvimento de interfaces com React.js', 2.5),
(5, 'Angular', 'Framework Angular para desenvolvimento web', 4.0),
(6, 'SQL', 'Linguagem SQL para manipulação de bancos de dados relacionais', 3.5),
(7, 'MongoDB', 'Banco de dados NoSQL MongoDB', 6.0),
(8, 'Desenvolvimento Android', 'Conceitos e práticas de desenvolvimento Android', 2.0),
(9, 'Desenvolvimento iOS', 'Conceitos e práticas de desenvolvimento iOS', 4.5),
(10, 'Introdução ao Machine Learning', 'Conceitos básicos de Machine Learning', 3.0);

-- Inserções para a tabela TBModuloM_Materia (Associação entre Módulos e Matérias)
INSERT INTO TBModuloM_Materia (IDModulo, IDMateria) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 3),
(3, 6),
(4, 1),
(5, 1),
(6, 4),
(6, 5),
(7, 6),
(7, 7),
(8, 8),
(9, 8),
(9, 9),
(10, 10);

-- Inserções para a tabela TBTurma
INSERT INTO TBTurma (IDTurma, Nome, Horario, IDCurso, Modalidade) VALUES
(1, 'Turma de Desenvolvimento Front-end 2023', '09:00:00', 1, 'Presencial'),
(2, 'Turma de Desenvolvimento Back-end 2023', '14:30:00', 2, 'Remoto'),
(3, 'Turma Full Stack 2023', '11:15:00', 3, 'Presencial'),
(4, 'Turma de Banco de Dados 2023', '13:45:00', 4, 'Remoto'),
(5, 'Turma de Mobile App Development 2023', '10:30:00', 5, 'Presencial'),
(6, 'Turma de Inteligência Artificial 2023', '16:00:00', 6, 'Remoto'),
(7, 'Turma de Segurança da Informação 2023', '08:45:00', 7, 'Presencial'),
(8, 'Turma de Desenvolvimento Ágil 2023', '15:15:00', 8, 'Remoto');

-- Inserções para a tabela TBTurma_Materia (Associação entre Turmas e Matérias)
INSERT INTO TBTurma_Materia (IDTurma, IDMateria) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 2),
(2, 3),
(2, 6),
(3, 1),
(3, 4),
(3, 5),
(4, 6),
(4, 7),
(4, 2),
(5, 8),
(5, 9),
(5, 2),
(6, 10),
(6, 7),
(6, 6),
(7, 3),
(7, 4),
(7, 8),
(8, 5),
(8, 9),
(8, 10);

-- Inserções para a tabela TBGrauInstrucao
INSERT INTO TBGrauInstrucao (IDGrau, Nome) VALUES
(1, 'Graduação'),
(2, 'Mestrado'),
(3, 'Doutorado');

-- Inserções para a tabela TBProfessor
INSERT INTO TBProfessor (IDProfessor, Nome, IDGrau) VALUES
(1, 'Prof. Silva', 1),
(2, 'Prof. Oliveira', 2),
(3, 'Prof. Santos', 3),
(4, 'Prof. Pereira', 1),
(5, 'Prof. Costa', 2),
(6, 'Prof. Lima', 3),
(7, 'Prof. Souza', 1),
(8, 'Prof. Rocha', 2),
(9, 'Prof. Martins', 3),
(10, 'Prof. Almeida', 1);


-- Inserções para a tabela TBProfessorMateria (Associação entre Professores e Matérias)
INSERT INTO TBProfessorMateria (IDMateria, IDProfessor) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(1, 10),
(2, 9),
(3, 8),
(4, 7),
(5, 7),
(6, 5),
(7, 6),
(8, 4),
(9, 3),
(10, 2);

-- Inserções para a tabela TBResponsavel
INSERT INTO TBResponsavel (IDResponsavel, Nome, CPF) VALUES
(1, 'Ana Silva', '12345678901'),
(2, 'Carlos Oliveira', '23456789012'),
(3, 'Mariana Santos', '34567890123'),
(4, 'Paulo Rocha', '45678901234'),
(5, 'Juliana Costa', '56789012345'),
(6, 'Lucas Lima', '67890123456'),
(7, 'Fernanda Souza', '78901234567'),
(8, 'Gabriel Almeida', '89012345678'),
(9, 'Isabela Martins', '90123456789'),
(10, 'Diego Almeida', '01234567890'),
(11, 'Renata Lima', '11122233344'),
(12, 'Ricardo Rocha', '22233344455'),
(13, 'Camila Souza', '33344455566'),
(14, 'Gustavo Costa', '44455566677'),
(15, 'Larissa Oliveira', '55566677788'),
(16, 'Henrique Santos', '66677788899'),
(17, 'Amanda Almeida', '77788899900'),
(18, 'Alexandre Lima', '88899900011'),
(19, 'Mariana Souza', '99900011122'),
(20, 'Felipe Costa', '00011122233'),
(21, 'Julia Lima', '09876543210'),
(22, 'Lucas Rocha', '98765432109'),
(23, 'Ana Souza', '87654321098'),
(24, 'Bruno Costa', '76543210987'),
(25, 'Carolina Lima', '65432109876'),
(26, 'Daniel Almeida', '54321098765'),
(27, 'Eduarda Rocha', '43210987654'),
(28, 'Fábio Souza', '32109876543'),
(29, 'Natalia Costa', '21098765432'),
(30, 'Vinícius Lima', '10987654321');



-- Inserções para a tabela TBAluno
INSERT INTO TBAluno (Matricula, Nome, data_nasc, CPF, IDResponsavel, IDTurma) VALUES
(2, 'Maria Oliveira Jr.', '2001-02-20', '22233344455', 2, 2),
(3, 'Carlos Santos Jr.', '2002-03-25', '33344455566', 3, 3),
(4, 'Ana Pereira Jr.', '2003-04-30', '44455566677', 4, 4),
(5, 'Rafaela Costa Jr.', '2004-05-05', '55566677788', 5, 5),
(6, 'Fernando Lima Jr.', '2005-06-10', '66677788899', 6, 6),
(7, 'Juliana Souza Jr.', '2006-07-15', '77788899900', 7, 7),
(8, 'Daniel Rocha Jr.', '2007-08-20', '88899900011', 8, 8),
(9, 'Larissa Martins Jr.', '2008-09-25', '99900011122', 9, 1),
(10, 'Lucas Oliveira Jr.', '2009-10-30', '00011122233', 10, 2),
(11, 'Gabriel Almeida Jr.', '2010-11-05', '09876543210', 11, 3),
(12, 'Isabela Santos Jr.', '2011-12-10', '98765432109', 12, 4),
(13, 'Mateus Lima Jr.', '2012-01-15', '87654321098', 13, 5),
(14, 'Laura Rocha Jr.', '2013-02-20', '76543210987', 14, 6),
(15, 'Thiago Costa Jr.', '2014-03-25', '65432109876', 15, 7),
(16, 'Amanda Oliveira Jr.', '2015-04-30', '54321098765', 16, 8),
(17, 'Gustavo Almeida Jr.', '2016-05-05', '43210987654', 17, 1),
(18, 'Julia Martins Jr.', '2017-06-10', '32109876543', 18, 2),
(19, 'Lucas Souza Jr.', '2018-07-15', '21098765432', 19, 3),
(20, 'Fernanda Costa Jr.', '2019-08-20', '10987654321', 20, 4),
(21, 'Ricardo Lima Jr.', '2020-09-25', '11122233344', 21, 5),
(22, 'Camila Rocha Jr.', '2021-10-30', '22233344455', 22, 6),
(23, 'Diego Almeida Jr.', '2022-11-05', '33344455566', 23, 7),
(24, 'Carolina Santos Jr.', '2023-12-10', '44455566677', 24, 8),
(25, 'Vinícius Costa Jr.', '2024-01-15', '55566677788', 25, 1),
(26, 'Beatriz Oliveira Jr.', '2025-02-20', '66677788899', 26, 2),
(27, 'Pedro Lima Jr.', '2026-03-25', '77788899900', 27, 3),
(28, 'Natália Rocha Jr.', '2027-04-30', '88899900011', 28, 4),
(29, 'Eduardo Almeida Jr.', '2028-05-05', '99900011122', 29, 5),
(30, 'Mariana Santos Jr.', '2029-06-10', '00011122233', 30, 6);

-- Inserções para a tabela TBAvaliacao
INSERT INTO TBAvaliacao (IDAvaliacao, Conteudo, IDMateria) VALUES
(1, 'Prova de HTML e CSS', 1),
(2, 'Projeto JavaScript', 2),
(3, 'Desafio Node.js', 3),
(4, 'Projeto React.js', 4),
(5, 'Apresentação Angular', 5),
(6, 'Exame de SQL', 6),
(7, 'Desafio MongoDB', 7),
(8, 'Projeto Android', 8),
(9, 'Projeto iOS', 9),
(10, 'Trabalho de Machine Learning', 10);

-- Inserções para a tabela TBAluno_Avaliacao (Associação entre Alunos e Avaliações)
INSERT INTO TBAluno_Avaliacao (Matricula, IDAvaliacao, Nota) VALUES
(1, 1, 8.5),
(2, 2, 7.0),
(4, 4, 6.5),
(5, 5, 8.0),
(6, 6, 7.5),
(7, 7, 9.5),
(8, 8, 6.0),
(10, 10, 7.0),
(11, 1, 9.0),
(12, 2, 6.5),
(15, 5, 9.5),
(16, 6, 6.0),
(17, 7, 8.5),
(18, 8, 7.0),
(19, 9, 9.0),
(20, 10, 6.5),
(22, 2, 7.5),
(23, 3, 9.5),
(24, 4, 6.0),
(26, 6, 7.0),
(27, 7, 9.0),
(28, 8, 6.5),
(30, 10, 7.5);

-- script extração dos dados do banco de dados
use projetoCG;

-- INFORMÇÃO 1 
-- Selecionando a quantidade dos Cursos mais procurados no ano de 2023
SELECT c.Nome AS Curso, COUNT(a.Matricula) AS Alunos
FROM TBCurso c
INNER JOIN TBAluno a ON c.IDCurso = a.IDTurma
GROUP BY c.Nome
ORDER BY Alunos DESC;

-- INFORMAÇÃO 2
-- Selecionando o grau de instrução de cada professor da intitução
SELECT p.Nome "Professor" ,g.Nome "Grau de Instrução" 
FROM TBGrauInstrucao g, TBProfessor p 
WHERE g.IDGrau = p.IDGrau ;

-- INFORMAÇÃO 3
-- Selecionando quais as turmas pertencem a cada curso
SELECT c.Nome 'Curso', t.Nome 'Turma' 
FROM TBCurso c, TBTurma t 
WHERE c.IDCurso = t.IDCurso;

-- INFORMAÇÃO 4 
-- Selecionando a quantidade de alunos por turma
SELECT t.Nome "turma", count(*) "Numer de Alunos" 
FROM TBAluno a, TBTurma t 
WHERE a.IDTurma = t.IDTurma 
GROUP by t.Nome;

-- INFORMAÇÃO 5
-- Selecionando em qual filial está concentrada o maior número de alunos
SELECT t.IDTurma, COUNT(a.Matricula) AS Total_Alunos
FROM TBTurma t
INNER JOIN TBAluno a ON t.IDTurma = a.IDTurma
GROUP BY t.IDTurma
ORDER BY Total_Alunos DESC
LIMIT 1;

-- INFORMAÇÃO 6
-- Selecionando quantos curso são ofertados na modalidade presencial
SELECT COUNT(*) AS TotalCursosPresenciais
FROM TBTurma
WHERE Modalidade = 'Presencial';

-- INFORMAÇÃO 7
-- Selecionando qual matéria cada professor leciona
SELECT p.Nome AS Professor, m.Nome AS Materia
FROM TBProfessor AS p
JOIN TBProfessorMateria AS pm ON p.IDProfessor = pm.IDProfessor
JOIN TBMateria AS m ON pm.IDMateria = m.IDMateria;

-- INFORMAÇÃO 8
-- Selecionando nota que cada aluno tirou em suas respectivas avaliações
SELECT a.Nome as "Nome Aluno", av.conteudo "Avaliação", aa.nota 
FROM TBAluno a, TBAvaliacao av, TBAluno_Avaliacao aa 
WHERE a.matricula = a.matricula and aa.IDavaliacao = av.IDAvaliacao;

-- INFORMAÇÃO 9
-- Selecionando a media de notas por turma
SELECT TBTurma.Nome AS Turma, AVG(TBAluno_Avaliacao.Nota) AS Media_Notas
FROM TBTurma
JOIN TBAluno ON TBTurma.IDTurma = TBAluno.IDTurma
JOIN TBAluno_Avaliacao ON TBAluno.Matricula = TBAluno_Avaliacao.Matricula
GROUP BY TBTurma.Nome;

-- INFORMAÇÃO 10
-- Selecionando qual o nome e o CPF dos responsaveis de cada aluno
SELECT a.nome as "Nome Aluno", r.nome as "Nome responsavel", r.CPF as "CPF Responsavel"  
FROM TBAluno a, TBResponsavel r 
WHERE a.IDresponsavel = r.IDresponsavel;

-- INFORMAÇÃO 11
-- Selecionando quantas horas cada professor leciona por semana
SELECT p.Nome "Professor", sum(m.horas_semanais) 
FROM TBProfessor p, TBProfessorMateria PM, TBMateria m 
WHERE p.IDProfessor = PM.IDProfessor and PM.IDMateria = m.IDmateria 
GROUP by p.nome;

-- INFORMAÇÃO 12
SELECT TBAluno.Nome AS Aluno, TBResponsavel.Nome AS Contato
FROM TBAluno
JOIN TBResponsavel ON TBAluno.IDResponsavel = TBResponsavel.IDResponsavel;

-- INFORMAÇÃO 13
-- Selecionando qual A TURMA CADA ALUNO PERTENCE 
    select a.nome "Aluno", t.nome "Turma"  
    from TBAluno a, TBTurma t  
    where a.IDTurma = t.IDTurma; 

-- INFORMAÇÃO 14
-- Qual é o número total de estudantes cadastrados?
select count(*) as total_alunos
from TBAluno;


-- INFORMAÇÃO 15
-- Quais os alunos que estão em cursos de nível avançado?
select a.Nome as Total_Alunos_Avançados from TBAluno a
inner join TBTurma t on t.IDTurma = a.IDTurma
inner join TBCurso c on c.IDCurso = t.IDCurso
where c.Nivel = 'Avançado';

-- INFORMAÇÃO 16
-- Quais alunos fazem curso com duração maior ou igual a 8 meses?
select a.Nome as Nome, c.Nome as Curso, c.Duracao_meses as Duracao from TBAluno a
inner join TBTurma t on t.IDTurma = a.IDTurma
inner join TBCurso c on c.IDCurso = t.IDCurso
where c.Duracao_meses >=8
order by Duracao;

-- INFORMAÇÃO 17
--  Selecionando quais matérias pertencem a cada turma 
select t.Nome as "Turma", m.Nome as "Materia"  
from TBTurma t, TBTurma_Materia h , TBMateria m  
where h.IDTurma = t.IDTurma and h.IDMateria = m.IDMateria; 

-- INFORMAÇÃO 18
-- Selecionando a quantidade de professores possui um determinado grau de instrução 
select g.Nome 'Grau de Instrução', Count(*) "Numero de Professores"  
from TBGrauInstrucao g, TBProfessor p  
where p.IDGrau = g.IDGrau  
group by g.Nome; 

-- INFORMAÇÃO 19
-- Selecionando quantas horas cada professor leciona por semana
select p.Nome "Professor", sum(m.horas_semanais) 
	from TBProfessor p, TBProfessorMateria PM, TBMateria m 
    where p.IDProfessor = PM.IDProfessor and PM.IDMateria = m.IDmateria 
    group by p.nome;

-- INFORMAÇÃO 20
-- Qual a media das notas dos alunos?
SELECT AVG(Nota) AS Media_das_Notas_dos_Alunos
FROM TBAluno_Avaliacao;


-- INFORMAÇÃO 21
-- Qual é a quantidade de alunos matriculados em cada turma e o correspondente nome do curso e o nome do tema?
select t.Nome as Turma, c.Nome as Curso, tema.Nome as Tema, count(a.Matricula) as Quantidade_alunos from TBTurma t
inner join TBAluno a on t.IDTurma = a.IDTurma
inner join TBCurso c on t.IDCurso = c.IDCurso
inner join TBModulo m on m.IDCurso = c.IDCurso
inner join TBTema tema on tema.IDTema = m.IDTema
group by t.Nome, c.Nome, tema.Nome;


-- INFORMAÇÃO 22
-- Quais são os alunos que não realizaram todas as avaliações?
SELECT a.Nome FROM TBAluno a
WHERE a.Matricula NOT IN (SELECT Matricula FROM TBAluno_Avaliacao);



-----------------------------------------------------------------------------------------------------------------------------------------------

Create Table Coordenador(
	IDC int primary key,
    usuario varchar(10),
    CPF varchar(11)
);

insert into Coordenador values(1, 'admin', 'admin123');

