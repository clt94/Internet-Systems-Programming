
USE coursesCS;


/*CSsystems, CSmgmt, CSminor used for display purposes */
DROP TABLE IF EXISTS CSsystems;

CREATE TABLE CSsystems (
  Subject_number INT(5) NOT NULL,
  Course_number INT(3) NOT NULL,
  Course_name CHAR(72),
  Credit TINYINT(1),
  Elective boolean,	
  PRIMARY KEY (Course_number)
);

insert into CSsystems values
(3450, 208, 'Introduction to Discrete Mathematics', 4, 0), 
(3460, 209, 'Computer Science I', 4,0),
(3460, 210, 'Computer Science II', 4,0),
(3450, 221, 'Analytic Geometry-Calculus I', 4, 0),

(3450, 222, 'Analytic Geometry-Calculus II', 4, 0),
(3460, 316, 'Data Structures', 3, 0),
(3460, 307, 'Internet Systems Programming', 3, 0),
(3460, 412, 'Software Design',3, 0),
(3460, 480, 'Software Engineering', 3, 0),
(3460, 490, 'Senior Seminar in Computer Science', 3, 0),
(3470, 401, 'Probablility and Statisitcs for Engineers', 2, 0),
(3470, 461, 'Applied Statisitics', 4, 0),
(4450, 320, 'Computer Systems', 3, 0),
(4450, 325, 'Operating Systems Concepts', 3, 0),
(3460, 426, 'Operating Systems', 3, 0);

DROP TABLE IF EXISTS CSmgmt;

CREATE TABLE CSmgmt (
  Subject_number INT(5) NOT NULL,
  Course_number INT(3) NOT NULL,
  Course_name CHAR(72),
  Credit TINYINT(1),
  Elective boolean,	
  PRIMARY KEY (Course_number)
);

insert into CSmgmt values
(3450, 208, 'Introduction to Discrete Mathematics', 4, 0), 
(3460, 209, 'Computer Science I', 4, 0),
(3460, 210, 'Computer Science II', 4, 0),
(3450, 221, 'Analytic Geometry-Calculus I', 4, 0),

(3450, 222, 'Analytic Geometry-Calculus II', 4, 0),
(3460, 316, 'Data Structures', 3, 0),
(3460, 435, 'Algorithms', 3, 0),
(3460, 475, 'Database Management', 3, 0),
(3460, 490, 'Senior Seminar in Computer Science', 3, 0),
(3470, 401, 'Probablility and Statisitcs for Engineers', 2, 0),
(3470, 461, 'Applied Statisitics', 4, 0),
(4450, 320, 'Computer Systems', 3, 0),
(4450, 325, 'Operating Systems Concepts', 3, 0),
(3460, 426, 'Operating Systems', 3, 0),
(6500, 301, 'Management: Principles and Concepts', 3, 0),
(6500, 480, 'Introduction to Health-Care Management', 3, 0),
(6500, 310, 'Business Information Systems', 3, 0);

DROP TABLE IF EXISTS CSminor;

CREATE TABLE CSminor(
  Subject_number INT(5) NOT NULL,
  Course_number INT(3) NOT NULL,
  Course_name CHAR(72),
  Credit TINYINT(1),
  Elective boolean,	
  PRIMARY KEY (Course_number)
);

insert into CSminor values
(3450, 208, 'Introduction to Discrete Mathematics', 4, 0), 
(3460, 209, 'Computer Science I', 4, 0),
(3460, 210, 'Computer Science II', 4, 0),
(3450, 221, 'Analytic Geometry-Calculus I', 4, 0);

DROP TABLE IF EXISTS CSelectives;

CREATE TABLE CSelectives(
  Subject_number INT(5) NOT NULL,
  Course_number INT(3) NOT NULL,
  Course_name CHAR(72),
  Credit TINYINT(1),
  Elective boolean);

insert into CSelectives values
(2240, 204, 'WAN Technologies', 3, 1),
(3350, 405, 'Geographic Information Systems', 3, 1),
(3350, 407, 'Advanced Geographic Information Systems', 3, 1),
(3450, 312, 'Linear Algebra', 3, 1), 
(3450, 415, 'Combinatorics and Graph Theory', 3, 1),
(3450, 427, 'Applied Numerical Methods I', 3, 1),
(3450, 428, 'Applied Numerical Methods II', 3, 1),
(3450, 430, 'Numerical Solutions for Partrial Differential Equations', 3, 1),
(3450, 472, 'Mathematical Models', 3, 1),
(3470, 480, 'Statisitcal Data Management', 3, 1),
(4450, 410, 'Embedded Scientific Computing', 3, 1),
(4450, 415, 'System Simulation', 3, 1),
(4450, 420, 'Computer Systems Design', 3, 1),
(4450, 422, 'Embedded Systems Interfacing', 3, 1),
(4450, 427, 'Computer Networks', 3, 1),
(4450, 440, 'Digital Signal Processing', 3, 1),
(4450, 462, 'Analog Integrated Circuit Design', 3, 1),
(4450, 465, 'Programmable Logic', 3, 1),
(4450, 467, 'VLSI Circuits and Systems', 3, 1),
(7100, 489, 'Special Topics in Studio Art', 3, 1);


DROP TABLE IF EXISTS studentAccounts;

CREATE TABLE studentAccounts(
  Username VARCHAR(12) NOT NULL,
  FirstName CHAR(72),
  LastName CHAR(72),
  Major CHAR(20),
  PRIMARY KEY (Username)
);

DROP TABLE IF EXISTS empty;

CREATE TABLE empty (
  Subject_number INT(5) NOT NULL,
  Course_number INT(3) NOT NULL,
  Course_name CHAR(72),
  Credit TINYINT(1),
  Elective boolean,	
  PRIMARY KEY (Course_number)
);

