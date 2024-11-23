CREATE DATABASE student_grades;

USE student_grades;

CREATE TABLE STUDENTS(
  studentid VARCHAR(10) PRIMARY KEY, 
  lastname VARCHAR(50) NOT NULL, 
  firstname VARCHAR(50) NOT NULL, 
  dob DATE
);

CREATE TABLE COURSES(
  courseid VARCHAR(10) PRIMARY KEY, 
  coursename VARCHAR(100) NOT NULL, 
  credits INT NOT NULL
);

CREATE TABLE GRADES(
  courseid VARCHAR(10), 
  studentid VARCHAR(10), 
  term INT, 
  grade VARCHAR(3) NULL, 
  PRIMARY KEY(courseid, studentid, term), 
  FOREIGN KEY(courseid) REFERENCES COURSES(courseid), 
  FOREIGN KEY(studentid) REFERENCES STUDENTS(studentid)
);

SELECT * FROM STUDENTS;
SELECT * FROM COURSES;
SELECT * FROM GRADES;

INSERT INTO STUDENTS 
VALUES 
  ('01', 'Sumi', 'Surenkhuu', '1997-10-20'), 
  ('02', 'Martin', 'Genao', '1996-05-15'), 
  ('03', 'Ann', 'Vu', '1997-01-01'),
  ('04', 'Daniyal', 'Tariq Butt', '1996-12-09');

INSERT INTO COURSES 
VALUES
  ('CSC263', 'Database Management', 4),
  ('MTH220', 'Mathematics', 3);

INSERT INTO GRADES 
VALUES
  ('CSC263', '01', 2024, 'A'),
  ('MTH220', '02', 2020, NULL),
  ('CSC263', '03', 2023, 'B+'),
  ('MTH220', '04', 2022, NULL);