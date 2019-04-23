CREATE DATABASE IF NOT EXISTS id7373992_cmd;
CREATE TABLE id7373992_cmd.users(
	matric VARCHAR(6) NOT NULL,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	ic VARCHAR(12) NOT NULL,
	email VARCHAR(100) NOT NULL,
	picture TEXT,
	programme VARCHAR(100),
	total_credit INT(3),
	major VARCHAR(100),
	user_type VARCHAR(7) NOT NULL,
	PRIMARY KEY (matric));
INSERT INTO id7373992_cmd.users VALUES ('000000', 'Admin', '12345', '901008127911', 'admin@gmail.com', '', '', '', '', 'admin');
INSERT INTO id7373992_cmd.users VALUES ('264321', 'Tan', '123', '980815012245', 'hunter961103@gmail.com', '', 'Information Technology', '132', '', 'student');
INSERT INTO id7373992_cmd.users VALUES ('257114', 'Sarah', '970213', '970213123034', 'sarah97@gmail.com', '', 'Business Administration', '129', '', 'student');

CREATE TABLE id7373992_cmd.courses(
	course_code VARCHAR(8) NOT NULL,
	course_name VARCHAR(100) NOT NULL,
	course_prerequisite VARCHAR(100),
	credit_hour INT(2) NOT NULL,
	programme VARCHAR(100),
	course_type VARCHAR(100) NOT NULL,
	major VARCHAR(100),
	PRIMARY KEY (course_code));
INSERT INTO id7373992_cmd.courses VALUES ('MPU3113', 'Ethnic Relationship', '', '3', '', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('MPU3123', 'Islamic Asian Civilization', '', '3', '', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SADE1013', 'Introduction to Entrepreneurship', '', '3', '', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SADN1033', 'Malaysian Nationhood Studies', '', '3', '', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE1063', 'English Proficiency 1', '', '3', 'Information Technology', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE2113', 'English Proficiency 2', '', '3', 'Information Technology', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE3123', 'English Proficiency 3', '', '3', 'Information Technology', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BWFF1013', 'Fundamentals of Finance', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SGDN1043', 'Science of Thinking and Ethics', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIA1113', 'Programming 1', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIA1123', 'Programming 2', 'Programming 1', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIA2024', 'Data Structures and Algorithm Analysis', 'Programming 1', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID3014', 'Database System and Information Retrieval', 'Data Structures and Algorithm Analysis', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID3024', 'System Analysis and Design', 'Programming 1', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID3074', 'IT Project Management', 'System Analysis and Design', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID3113', 'Research Method in IT', 'Statistics for Information Technology', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIJ2024', 'Basic Networking', 'Computer System Organization', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIK1014', 'Computer System Organization', 'Programming 1', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIK2044', 'Operating System', 'Computer System Organization', '4', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIN1013', 'Introduction to Artificial Intelligence', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIV2013', 'Human Computer Interaction', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIX3912', 'Practicum', 'All', '12', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIX3913', 'Project 1', 'IT Project Management', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STIX3923', 'Project 2', 'Project 1', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STQM1203', 'Mathematics for Information Technology', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STQM2103', 'Discrete Structure', 'Mathematics for Information Technology', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STQS1023', 'Statistics for Information Technology', '', '3', 'Information Technology', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID3034', 'Information Technology Management', 'Basic Networking, System Analysis and Design', '4', 'Information Technology', 'Field of Concentration', 'Information Management');
INSERT INTO id7373992_cmd.courses VALUES ('STID3124', 'Database Administration', 'Database System and Information Retrieval', '4', 'Information Technology', 'Field of Concentration', 'Information Management');
INSERT INTO id7373992_cmd.courses VALUES ('STID3154', 'IT Entrepreneurship', '', '4', 'Information Technology', 'Field of Concentration', 'Information Management');
INSERT INTO id7373992_cmd.courses VALUES ('STID4064', 'Information Resource Management', 'Information Technology Management', '4', 'Information Technology', 'Field of Concentration', 'Information Management');
INSERT INTO id7373992_cmd.courses VALUES ('STID4074', 'Information Strategic Planning', 'Information Technology Management', '4', 'Information Technology', 'Field of Concentration', 'Information Management');
INSERT INTO id7373992_cmd.courses VALUES ('STIN2024', 'Logic Programming', 'Introduction to Artificial Intelligence', '4', 'Information Technology', 'Field of Concentration', 'Intelligent System');
INSERT INTO id7373992_cmd.courses VALUES ('STIN2044', 'Knowledge Discovery in Database', 'Introduction to Artificial Intelligence', '4', 'Information Technology', 'Field of Concentration', 'Intelligent System');
INSERT INTO id7373992_cmd.courses VALUES ('STIN2054', 'Neural Network', 'Knowledge Discovery in Database', '4', 'Information Technology', 'Field of Concentration', 'Intelligent System');
INSERT INTO id7373992_cmd.courses VALUES ('STIN2064', 'Machine Learning', 'Knowledge Discovery in Database', '4', 'Information Technology', 'Field of Concentration', 'Intelligent System');
INSERT INTO id7373992_cmd.courses VALUES ('STIN2104', 'Expert System and Knowledge Engineering', 'Introduction to Artificial Intelligence', '4', 'Information Technology', 'Field of Concentration', 'Intelligent System');
INSERT INTO id7373992_cmd.courses VALUES ('STIJ3044', 'Routing Protocols and Concepts', 'Basic Networking', '4', 'Information Technology', 'Field of Concentration', 'Computer Network');
INSERT INTO id7373992_cmd.courses VALUES ('STIJ3064', 'Distributed Computing', 'Database System and Information Retrieval', '4', 'Information Technology', 'Field of Concentration', 'Computer Network');
INSERT INTO id7373992_cmd.courses VALUES ('STIJ3104', 'Network Management', 'Basic Networking', '4', 'Information Technology', 'Field of Concentration', 'Computer Network');
INSERT INTO id7373992_cmd.courses VALUES ('STIJ3134', 'Network and System Security', 'Network Management', '4', 'Information Technology', 'Field of Concentration', 'Computer Network');
INSERT INTO id7373992_cmd.courses VALUES ('STIK2024', 'Computer System Architecture', 'Computer System Organization', '4', 'Information Technology', 'Field of Concentration', 'Computer Network');
INSERT INTO id7373992_cmd.courses VALUES ('STIW2024', 'Software Engineering', 'Data Structures and Algorithm Analysis', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('STIW2044', 'Mobile Programming', 'Data Structures and Algorithm Analysis', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('STIW3034', 'Software Testing and Quality Assurance', 'System Analysis and Design', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('STIW3044', 'Web Engineering', 'System Analysis and Design', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('STIW3054', 'Real-time Programming', 'System Analysis and Design', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('STIW3064', 'Component Based Development', 'System Analysis and Design', '4', 'Information Technology', 'Field of Concentration', 'Software Engineering');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE1033', 'English for Communication 1', '', '3', 'Business Administration', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE1043', 'English for Communication 2', '', '3', 'Business Administration', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE2103', 'Process Writing', '', '3', 'Business Administration', 'University Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLF1053', 'Mandarin 1', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLF2053', 'Mandarin 2', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLF3053', 'Mandarin 3', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BEEB1013', 'Principles of Economy', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BJMQ3013', 'Quality Management', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BKAL1013', 'Business Accounting', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPBX4908', 'Practicum', 'All', '8', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPIN3053', 'Management Information System', 'Principles of Management', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPME2023', 'Creativity and Innovation', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPME3033', 'E-Commerce', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPME3073', 'Entrepreneurship', 'Introduction to Entrepreneurship', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMM1013', 'Introduction to Marketing', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN1013', 'Principles of Management', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN2023', 'Organizational Behavior', 'Principles of Management', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN3023', 'Strategic Management', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN3103', 'Seminar on Management Thinking', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN3123', 'Management Ethics', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BPMN3143', 'Research Methodology', 'Introduction to Statistics', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BSMH2013', 'Human Resource Management', 'Principles of Management', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('BWFF2033', 'Financial Management', 'Business Accounting', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('GFMA2023', 'International Business', 'Principles of Management', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('GLUL2023', 'Business Law', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SBLE2093', 'Business and Professional Communication', 'Process Writing', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SQQS1013', 'Introduction to Statistics', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('STID1103', 'Computer Applications in Management', '', '3', 'Business Administration', 'Programme Core', '');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT1033', 'Introduction to Media Technology', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT1093', 'Visual Media', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2033', 'Media Writing', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2043', 'Photography', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2063', 'Media Law and Ethics', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2073', 'Media Creativity and Esthetics', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2323', 'Investigative News Reporting', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT2413', 'Electronic Script Writing', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT3033', 'Media Psychology', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SCCT3233', 'Integrative Media Marketing', '', '3', 'Business Administration', 'Field of Concentration', 'Creative Media');
INSERT INTO id7373992_cmd.courses VALUES ('SSKC1013', 'Basic Principles of Counselling and Guidance', '', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSKC2313', 'Helping Skills', 'Basic Principles of Counselling and Guidance', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYA1013', 'Introduction to Psychology', '', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYD3033', 'Industrial and Organizational Psychology', 'Introduction to Psychology', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYM1023', 'Human Growth and Development', 'Introduction to Psychology', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYP2013', 'Personality', '', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYP2313', 'Abnormal Psychology', 'Introduction to Psychology', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYP2433', 'Health Psychology', 'Introduction to Psychology', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYP4543', 'Personnel Recruitment and Placement', 'Industrial and Organizational Psychology', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('SSYS2023', 'Social Psychology', '', '3', 'Business Administration', 'Field of Concentration', 'Applied Psychology');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB1013', 'Foundations of Banking', '', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB2013', 'Bank Management', '', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3013', 'Commercial Bank Operations', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3023', 'Lending Management', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3033', 'International Banking', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3043', 'Banking Securities', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3053', 'Marketing of Financial Services', '', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3063', 'International Trade and Finance', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3073', 'Treasury Management', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('BWBB3083', 'Corporate Banking', 'Bank Management', '3', 'Business Administration', 'Field of Concentration', 'Bank Management');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA1013', 'Introduction to Communication', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA1023', 'Communication Theory', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA2023', 'Human Communication', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA2073', 'Public Relations', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA2083', 'Communication Law', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCA2103', 'Leadership Communication', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCD3223', 'Persuasive Communication', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCD3253', 'International Media Analysis', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCG3123', 'Negotiation Communication', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');
INSERT INTO id7373992_cmd.courses VALUES ('SCCG3143', 'Managerial Communication Skills', '', '3', 'Business Administration', 'Field of Concentration', 'Corporate Communication');

CREATE TABLE id7373992_cmd.dashboard(
	dashboard_id INT(10) NOT NULL AUTO_INCREMENT,
	course_code VARCHAR(8) NOT NULL,
	semester INT(1) NOT NULL,
	grade VARCHAR(2),
	grade_point DECIMAL(3, 2),
	status VARCHAR(100) NOT NULL,
	matric VARCHAR(6) NOT NULL,
	PRIMARY KEY (dashboard_id));
	
CREATE TABLE id7373992_cmd.advisor(
	programme VARCHAR(100) NOT NULL,
	course_code VARCHAR(8) NOT NULL,
	semester INT(1) NOT NULL,
	major VARCHAR(100));
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'MPU3123', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SADN1033', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE1063', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SGDN1043', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIA1113', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQM1203', '1', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE2113', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIA1123', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN1013', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK1014', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIA2024', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQS1023', '2', '');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3024', '3', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ2024', '3', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3014', '3', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE3123', '3', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3154', '3', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3024', '3', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ2024', '3', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3014', '3', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE3123', '3', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN2024', '3', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3024', '3', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ2024', '3', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3014', '3', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE3123', '3', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK2024', '3', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3024', '3', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ2024', '3', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3014', '3', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SBLE3123', '3', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW2024', '3', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK2044', '4', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3074', '4', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIV2013', '4', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3034', '4', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3124', '4', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK2044', '4', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3074', '4', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIV2013', '4', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN2044', '4', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN2104', '4', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK2044', '4', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3074', '4', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIV2013', '4', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ3064', '4', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ3044', '4', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIK2044', '4', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3074', '4', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIV2013', '4', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW2044', '4', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW3044', '4', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'BWFF1013', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQM2103', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID4064', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3113', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION14', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3913', '5', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'BWFF1013', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQM2103', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN2054', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3113', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIN2064', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3913', '5', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'BWFF1013', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQM2103', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3113', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ3104', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION14', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3913', '5', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'BWFF1013', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STQM2103', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW3034', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID3113', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW3054', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3913', '5', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'MPU3113', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SADE1013', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STID4074', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION24', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3923', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTIONX3', '6', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'MPU3113', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SADE1013', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION14', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION24', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3923', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTIONX3', '6', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'MPU3113', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SADE1013', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIJ3134', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION24', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3923', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTIONX3', '6', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'MPU3113', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'SADE1013', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIW3064', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTION24', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3923', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'OPTIONX3', '6', 'Software Engineering');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3912', '7', 'Information Management');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3912', '7', 'Intelligent System');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3912', '7', 'Computer Network');
INSERT INTO id7373992_cmd.advisor VALUES ('Information Technology', 'STIX3912', '7', 'Software Engineering');