SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `test_generator`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `name`) VALUES
('1', 'GOM'),
('2', 'Part 61'),
('3', 'Part 91'),
('4', 'Part 135'),
('5', 'NVG'),
('6', 'Airspace'),
('7', 'NTSB Part 830');

-- --------------------------------------------------------

--
-- Table structure for table `evaluator`
--

CREATE TABLE `evaluator` (
  `pcode` varchar(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`pcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluator`
--

INSERT INTO `evaluator` (`pcode`, `name`, `email`, `password`) VALUES
('RCHM', 'Mark Chmieleski', 'mchmieleski@airmethods.com', 'dog123'),
('RGGP', 'Gracie Paws', 'gpaws@airmethods.com', 'paws123');

-- --------------------------------------------------------

--
-- Table structure for table `pilot`
--

CREATE TABLE `pilot` (
  `pcode` varchar(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`pcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilot`
--

INSERT INTO `pilot` (`pcode`, `name`, `email`) VALUES
('RORW', 'Orville Wright', 'owright@airmethods.com');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(4) NOT NULL AUTO_INCREMENT,
  `catid` varchar(10) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `reference` varchar(25) NOT NULL,
  PRIMARY KEY (`questionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionId`, `catid`, `question`, `answer`, `reference`) VALUES
(1, '2', 'When can you start logging NVG time?', 'When you are using NVG to see the surface.', ''),
(31, '2', 'Failure to submit to an alcohol test can result in.', 'Suspenstion or revocation of any certificate, rating issued under this part', '61.16'),
(32, '2', 'A second class medical is valid for how long?', '12 months', '61.23'),
(33, '2', 'After moving how long do you have to update your address with the FAa?', '30 days', '61.60'),
(34, '3', 'Who is the final authority as to the operation of the aircraft?', 'Pilot-in-Command', '91.3'),
(35, '3', 'Can you demonstrate your skills as a plot by performing aerobatics with the med-crew on board', 'No person may operate an aircraft in a careless or reckless manner', '91.13'),
(36, '3', 'You stayed up until midnight the night before drinking. Can you start your shift at 07:00AM', 'No you may not act as a crew member within 8 hours after the consumption of any alcoholic beverage', '91.17'),
(37, '3', 'You pick up a patent who states that he has a little marihuana on him, can he take this with him on the flight?', 'No, No person may operate a civil aircraft with knowledge that narcotics are carried in the aircraft', '91.19'),
(38, '3', 'Each Pilot-in-Command shall before beginning a flight will become familiar with what?', 'All available information concerning that flight', '91.103'),
(39, '3', 'Can a Med-crew member come out of their shoulder harness to tend to a patient?', 'Yes if the crew member would be unable to perform their duties with the harness fastened', '91.105'),
(40, '3', 'A mother is coming along on a flight to comfort her child. Does she need to be briefed on how to use her seatbelt?', 'Yes, the Pilot-in-Command must ensure that each person on board has been briefed on how to fasten and unfasten their seatbelt.', '91.107'),
(41, '3', 'If you see another AMRG aircraft returning to the same airport that you are going to can you fly in formation with them?', 'No person may operate an aircraft carrying passengers for hire in formation flight', '91.11'),
(42, '3', 'You see another aircraft approaching head on, each pilot shall do what', 'Alter course to the right', '91.113'),
(43, '3', 'According to Part 91, at what altitude must you be at to overfly a congested area?', '1,000 feet above the highest obstacle with a radius of 2,000 of the aircraft', '91.119'),
(44, '3', 'When can you deviate from an ATC clearance?', 'Ameneded clearance has been received, Emregency exists, or deviation is in response to a traffic alert and collision avoidance system resolution advisory', '91.123'),
(45, '3', 'Your radio is out and you are returning to the airport, Tower flashes a steady Red light, what are your actions', 'Give way to other aircraft and continue circling', '91.125'),
(46, '3', 'What are your VFR fuel reserves at night in helicopters', 'Takeoff with enough fuel to fly to the first point of intended landing and assuming normal cruise speed fly and additional 20 minutes', '91.151'),
(47, '3', 'What are your cloud clearance and visibility requirements when in Class E airspace, less than 10,000 feet MSL', '3 statue miles, 500 feet below, 1,000 feet above, 2,000 feet horizontal', '91.155'),
(48, '3', 'You''re on a magnetic heading of 155 degrees, greater than 3,000 feet AGL, what altitdude should you be at?', 'Any odd thousand foot MSL altitude +500 feet', '91.159'),
(49, '3', 'What are your fuel requirements for helicopters IFR?', 'Fly to intedneded landing, then to alternate and then fly 30 minutes at normal causing speed', '91.167'),
(50, '3', 'VOR needs to be checked every how many days to use if for IFR operations', '30 days', '91.171'),
(51, '3', 'According to Part 91, what instruments and equipment need to be installed and operational in the aircraft to operate it under NVGs', 'Equipent list in Para. B of this section and the following, NVGs, interior/exterior lights required for NVGs, two-way radio, artificail horizon, generator and radar altimeter', '91.205'),
(52, '3', 'When must you replace the battery in the ELT?', 'When more than 1 cumulative hour has been used or when 50% of its useful life has expired', '91.207'),
(53, '3', 'When must the aircraft''s position lights be turned on?', 'During the period of sunset to sunrise', '91.209'),
(54, '3', 'When can you takeoff with inoperative equipment?', 'An approved MEL exists for that aircraft and item inoperative is on that lisst', '91.213'),
(55, '3', 'You are below the altitude of the Salt Lake City Class B airspace, do you need an operational transponder?', 'Yes', '91.215'),
(56, '3', 'Can you turn off the collision avoidance system if you don''t like listening to it?', 'No, each person operating an aircraft equipped with an operable traffic alert system shall have that system on and operating', '91.221'),
(57, '4', 'Does the aircraft maintenance log need to be carried on board the aircraft?', 'Yes', '135.65'),
(58, '4', 'What must the pilot do if they encounter a potentially hazardous weather condition?', 'The pilot shall notify an appropriate ground radio station as soon as practicable', '135.67'),
(59, '4', 'What subjecats must be briefed to passengers before flight?', 'Smoking, Use of Safet belts, placement of the seat backs, location and means for opening the passenger door and emergency exits, location of survival equipment, location and operation of fire extinguisher', '135.117'),
(60, '4', 'Who should assign each crew member the necessary functions to be performed in an emergency', 'The certificate holder', '135.23'),
(61, '4', 'Except as necessary for takeoff and landing,  no person may operate under VFR a helicopter over a congested area at an altitude of what above the surface?', '300 feet', '135.203'),
(62, '4', 'No person may operate a helicopter under VFR unless that person has what?', 'Visual surface feference or at night visual surface light reference', '135.207'),
(63, '4', 'Can you take off with frost on the main rotor blades?', 'No pillot may takeoff an aircraft that has frost, ice or snow adhering to any rotor blade', '135.227'),
(64, '4', 'If you are required to drive to another base to work a shift, not local in nature, does the time spent in transportation consider part of your rest period?', 'No it is not consided part of a rest period', '135.263'),
(65, '4', 'How many flight hores can you fly during any consecutive 24 hours', '8', '135.265'),
(66, '4', 'If you pick up a hunter at a scene, can he carry his weapon on board the aircraft with him', 'No may carry a deadly weapon on board the aircraft operated by the certificate holder', '135.119'),
(67, '4', 'According to Part 135, what is the definition of a Rest Period', 'A period free of all responsibility for work or duty', '135.273'),
(68, '4', 'If the radar altimeter is inoperative, can you still operate the helicopter?', 'No, unless authorizes int he certificate holder''s approved MEL', '135.160'),
(69, '5', 'NVGs need to be inspected every how many days?', '180 days', 'NVG Maintenance sheet'),
(70, '5', 'What is the field of view when using NVGs?', '40 degrees', 'NVG Operators Manual'),
(71, '5', 'What is your NVG currency?', '6 HNVGOs, within the two previous calendar months, not including the current month', '61.57, GOM'),
(72, '5', 'Do NVGs magniy images?', 'No the ratio is 1:1', 'NVG Class'),
(73, '5', 'What is the best visual acuity with NVGs?', '20/40', 'NVG Class'),
(74, '5', 'What are the operational defects of NVGs?', 'Shading, Edge Glow, Flashing/Flickering or intermittent operation', 'NVG Class'),
(75, '5', 'What are the 7 cosmetic blemishes with NVGs?', 'Bright spots, Black Spots, Chicken wire, Image distortion, Fixed pattern noise, image disparity, Output brightness variation', 'NVG Class'),
(76, '6', 'What are the 4 types of airspace', 'Controled, Uncontroled, Special Use and Other airspace', 'AIM 3-1-1'),
(77, '6', 'What is your Basic VFR weather minimums in Class B airspace', '3 statue miles, clear of clouds', 'AIM 3-1-4'),
(78, '6', 'What equipment do you need to fly into Class C airspace?', 'Two-way radio and operable transponder with automatic altitude reporting', 'AIM 3-2-4'),
(79, '6', 'How is Class D airspace depicted on a Sectional Chart?', 'Segmeneed blue line', 'Sectional Chart'),
(80, '6', 'How is surfaced based Class E airspace depicted on a Sectional Chart?', 'Segmented magenta line', 'Sectional Chart'),
(81, '6', 'Where can I find the operating hours and controlling agency for a Restricted Area', 'Margin section of the sectional chart', 'Sectional Chart'),
(82, '6', 'As a VFR pilot can you fly through an active MOA?', 'Yes, but you should excretes extreme caution and contact the controlling agency for traffic advisories', 'AIM 3-4-5'),
(83, '6', 'Do you need a clearance to fly into Class B airspace', 'Yes', '91.131'),
(84, '1', 'What does a Helicopter Night Vision Goggle operation consist of?', 'A helicopter night vision goggle operation consists of a before takeoff check, takeoff, climbout, cruise, descent, approach, and landing. Including, hovering tasks, area departure and area arrival tasks initial reconnaissance, transitioning from aided flight aided flight means that the pilot uses night vision goggles to maintain visual surface reference to unaided night flight and back to aided flight.', 'GOM 8.13'),
(85, '1', 'When should the decision to go-around be made during a Confined Area Approach?', 'The decision to go-around should be made before descending below obstacles or decelerating below effective translational lift.', 'GOM 8.16'),
(86, '1', 'What is the NVG currency for med-crew members?', '3 HNVGOs within the previous 6 months', 'GOM 8.20'),
(87, '1', 'For HNVGO operations below 300 feet, what must be met?', 'One other person needs to be on NVGs', 'GOM 8.21'),
(88, '1', 'Before entering IIMC what should the pilot attempt first?', 'Circumnavigate local IMC, Turn away from the condition, Land at an appropriate alternate site.', 'GOM 8.24'),
(89, '1', 'When conducting route planning, how far left and right of course do you go to determine your highest obstacle?', '2 NM', 'GOM 8.26'),
(90, '1', 'When on the ground there will be a minimum of how many feet from obstructions?', '15 feet', 'GOM 8.31'),
(91, '1', 'You are enroute to a scene call where there is no designated frequency, What frequency will you announce your intentions on?', '123.025', 'GOM 8.36'),
(92, '1', 'What are your day and night Special VFR minimums?', '700-2 Day, 800-3 Night', 'GOM 8.38'),
(93, '1', 'What are the four reasons given in the GOM to do a Precautionary Landing', 'Maintenance difficulties, Adverse weather, Difficulties with a passenger, As deemed necessary by the PIC', 'GOM 8.42'),
(94, '1', 'How do you remove frost from the main rotor blades?', 'Start and run-up the aircraft Shutdown. Visually check all aircraft surfaces for evidence of frost. All remaining frost must be removed. If no frost is present, the helicopter may continue the assigned mission', 'GOM 8.11 '),
(95, '1', 'Refueling operations shall not be conducted during periods of active thunderstorms and detected lightning, within how many miles of refueling operations?', '5 Miles', 'GOM 8.8'),
(96, '1', 'Can you leave the controls when the rotors are turning', 'No', 'GOM 8.1'),
(97, '1', 'The PIC must ensure that all terrain and obstacles along the route of flight, except for takeoff and landing, are cleared vertically by no less than what during the day and what during the night', '300'' Day, 500'' Night', 'GOM 8.5'),
(98, '7', 'What is the definition of an incident?', 'An occurrence other than an accident associated with the operation of an aircraft.', '830.2'),
(99, '7', 'What are the serious incidents that require immediate notification of the NTSB?', 'Flight control malfunction or failure, Inability of any required flight crew member to perform normal flight duties as a result of injury or illness, Failure of any internal turbine engine component that results in the escape of debris, in-flight fire, aircraft collision in flight, damage to property other than the aircraft estimated to exceed $25,000, Damage to helicopter tail or main rotor blades, an aircraft overdue and is believed to have been involved in an accident', '830.5'),
(100, '7', 'How many day do you have to notify the NTSB of an accident?', '10 days', '830.15'),
(101, '7', 'Where can you find the list of information needed to be given to the NTSB when noticing them?', 'Part 830.6', '830.6');

-- --------------------------------------------------------

--
-- Table structure for table `testgen`
--

CREATE TABLE `testgen` (
  `testid` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `evalid` varchar(8) NOT NULL,
  `pilotid` varchar(8) NOT NULL,
  PRIMARY KEY (`testid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testgen`
--

INSERT INTO `testgen` (`testid`, `date_created`, `evalid`, `pilotid`) VALUES
('04481de', '2018-05-10 21:43:59', 'RCHM', 'RCHM'),
('1318f14', '2014-10-15 18:54:44', 'RCHM', 'RCHM'),
('13e08e6', '2014-03-19 20:35:25', '', 'RMMR'),
('1671ec9', '2014-04-16 22:14:51', 'RCHM', 'RCHM'),
('22dcf96', '2014-02-14 01:49:26', '', 'REMC'),
('34d7d38', '2014-11-05 21:31:10', 'RCHM', 'RTTT'),
('4a22aed', '2014-10-04 15:17:42', 'RCHM', 'RPPT'),
('643af0b', '2018-05-10 21:45:47', 'RCHM', 'rjoe'),
('6dc12cf', '2014-05-05 16:51:15', 'RCHM', 'RCHM'),
('730c25e', '2014-03-08 21:28:35', '', 'RTAC'),
('80a904a', '2014-05-01 18:15:13', 'RCHM', 'RDCT'),
('ac1d595', '2014-02-27 00:39:48', '', 'RCHM'),
('ae1e962', '2014-04-28 18:12:47', '', 'RCCM'),
('af360a6', '2014-03-04 02:59:21', '', 'RJDD'),
('c93e1ce', '2014-04-28 18:10:25', 'RCHM', 'RCCM'),
('cbb7afd', '2014-12-09 23:40:36', 'RCHM', 'RTTT'),
('dd0bd81', '2014-04-29 20:02:28', 'RCHM', 'RORT'),
('e3aece5', '2014-02-13 20:14:30', '', 'RORW'),
('f554748', '2014-11-11 16:17:09', 'RCHM', ''),
('fb74a5a', '2016-03-02 15:11:15', 'RCHM', 'rchm'),
('fffcad9', '2014-03-28 17:50:02', 'RCHM', 'RSCC');

-- --------------------------------------------------------

--
-- Table structure for table `testsubmit`
--

CREATE TABLE `testsubmit` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `testid` varchar(10) NOT NULL,
  `questionid` varchar(50) NOT NULL,
  `answer` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `corrected` tinyint(1) NOT NULL,
  `taken` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Dumping data for table `testsubmit`
--

INSERT INTO `testsubmit` (`id`, `testid`, `questionid`, `answer`, `date`, `corrected`, `taken`) VALUES
(15, 'e3aece5', '6', 'cat', '0000-00-00 00:00:00', 1, 0),
(16, 'e3aece5', '4', 'dog', '0000-00-00 00:00:00', 1, 0),
(17, 'e3aece5', '5', 'blue line', '0000-00-00 00:00:00', 0, 0),
(18, '22dcf96', '6', 'When I leave home.', '0000-00-00 00:00:00', 0, 0),
(19, '22dcf96', '22', '700-2, 800-3', '0000-00-00 00:00:00', 1, 0),
(20, '22dcf96', '1', '1 hour after sunset', '0000-00-00 00:00:00', 1, 0),
(21, '22dcf96', '29', 'PIREP', '0000-00-00 00:00:00', 0, 0),
(22, '22dcf96', '2', '30 min', '0000-00-00 00:00:00', 1, 0),
(23, '22dcf96', '3', 'You must maintain surface reference ', '0000-00-00 00:00:00', 1, 0),
(24, '22dcf96', '4', '6 HNVGOS within the previous to calendar months', '0000-00-00 00:00:00', 0, 0),
(25, '22dcf96', '5', 'dashed blue line', '0000-00-00 00:00:00', 0, 0),
(26, 'ac1d595', '22', '700-2, 800-3', '0000-00-00 00:00:00', 0, 0),
(27, 'ac1d595', '1', '1 hour after sunset', '0000-00-00 00:00:00', 0, 0),
(28, 'ac1d595', '29', 'PIREP', '0000-00-00 00:00:00', 0, 0),
(29, 'ac1d595', '3', 'Surface reference requirements ', '0000-00-00 00:00:00', 0, 0),
(40, '13e08e6', '22', '700-2 day 800-3 night', '2014-03-19 20:35:25', 0, 0),
(41, '13e08e6', '1', 'When I feel like it.', '2014-03-19 20:35:25', 1, 0),
(42, '13e08e6', '2', '20 per the FARS', '2014-03-19 20:35:25', 1, 0),
(43, '13e08e6', '3', 'Surface reference requirements.', '2014-03-19 20:35:25', 0, 0),
(44, '13e08e6', '4', '6 HNVGOs in the previous 2 calendar months. ', '2014-03-19 20:35:25', 0, 0),
(45, '13e08e6', '30', 'Dashed magenta line.', '2014-03-19 20:35:25', 0, 0),
(74, 'c84be0a', '6', 'When you leave your home.', '2014-03-28 17:47:57', 0, 0),
(75, 'c84be0a', '1', '1 hour after sunset.', '2014-03-28 17:47:57', 0, 0),
(76, 'c84be0a', '3', 'Surface reference requirements.', '2014-03-28 17:47:57', 0, 0),
(77, 'c84be0a', '5', 'dashed blue line.', '2014-03-28 17:47:57', 0, 0),
(78, 'fffcad9', '22', 'When you leave your home.', '2014-03-28 17:50:02', 0, 0),
(79, 'fffcad9', '1', '1 hour after sunset.', '2014-03-28 17:50:02', 0, 0),
(80, 'fffcad9', '3', 'Surface reference requirements.', '2014-03-28 17:50:02', 0, 0),
(81, 'fffcad9', '30', 'dashed blue line.', '2014-03-28 17:50:02', 0, 0),
(82, '1671ec9', '22', '700-2 800-3', '2014-04-16 22:14:51', 0, 0),
(83, '1671ec9', '6', 'blahh', '2014-04-16 22:14:51', 0, 0),
(84, '1671ec9', '1', 'when I feel like it', '2014-04-16 22:14:51', 0, 0),
(85, '1671ec9', '2', 'who care', '2014-04-16 22:14:51', 0, 0),
(86, '1671ec9', '4', 'whenever', '2014-04-16 22:14:51', 0, 0),
(87, '1671ec9', '30', 'dashed line', '2014-04-16 22:14:51', 0, 0),
(88, 'c93e1ce', '22', '700-2 day, 800-3 night', '2014-04-28 18:10:25', 0, 0),
(89, 'c93e1ce', '6', 'When you leave your house.', '2014-04-28 18:10:25', 0, 0),
(90, 'c93e1ce', '1', '1 hour after sunset.', '2014-04-28 18:10:25', 0, 0),
(91, 'c93e1ce', '2', '30 min per GOM and FARs', '2014-04-28 18:10:25', 0, 0),
(92, 'c93e1ce', '5', 'Dashed blue line', '2014-04-28 18:10:25', 0, 0),
(93, 'c93e1ce', '30', 'dashed pink line', '2014-04-28 18:10:25', 0, 0),
(94, 'ae1e962', '22', '700-2 day, 800-3 night', '2014-04-28 18:12:47', 0, 0),
(95, 'ae1e962', '6', 'When you leave your house.', '2014-04-28 18:12:47', 1, 0),
(96, 'ae1e962', '1', '1 hour after sunset.', '2014-04-28 18:12:47', 1, 0),
(97, 'ae1e962', '2', '30 min per GOM and FARs', '2014-04-28 18:12:47', 0, 0),
(98, 'ae1e962', '5', 'Dashed blue line', '2014-04-28 18:12:47', 0, 0),
(99, 'ae1e962', '30', 'dashed pink line', '2014-04-28 18:12:47', 0, 0),
(100, 'dd0bd81', '6', 'When I leave home', '2014-04-29 20:02:29', 0, 0),
(101, 'dd0bd81', '22', '700-2 day, 800-3 night', '2014-04-29 20:02:29', 0, 0),
(102, '80a904a', '5', 'How now', '2014-05-01 18:15:13', 0, 0),
(103, '80a904a', '30', 'brown cow', '2014-05-01 18:15:13', 0, 0),
(104, '6dc12cf', '6', 'when I leave home', '2014-05-05 16:51:15', 0, 0),
(105, '6dc12cf', '1', 'now', '2014-05-05 16:51:15', 0, 0),
(106, '6dc12cf', '29', 'leave', '2014-05-05 16:51:15', 0, 0),
(107, '4a22aed', '6', 'When you leave home', '2014-10-04 15:17:42', 0, 0),
(108, '4a22aed', '22', '700 -  2 day, 800 - 3 night', '2014-10-04 15:17:42', 1, 0),
(109, '4a22aed', '1', '1 hour after sunset and using the NVGs', '2014-10-04 15:17:42', 0, 0),
(110, '4a22aed', '29', 'PIREP', '2014-10-04 15:17:42', 0, 0),
(111, '4a22aed', '2', 'Fly to the destination and then for 20 minutes at normal cruise', '2014-10-04 15:17:42', 1, 0),
(112, '4a22aed', '4', '6 HNVGO with in the previous 2 calendar months', '2014-10-04 15:17:42', 0, 0),
(113, '1318f14', '6', '', '2014-10-15 18:54:44', 0, 0),
(114, '1318f14', '22', '', '2014-10-15 18:54:44', 0, 0),
(115, '1318f14', '1', '', '2014-10-15 18:54:44', 0, 0),
(116, '1318f14', '2', '', '2014-10-15 18:54:44', 0, 0),
(117, '1318f14', '29', '', '2014-10-15 18:54:44', 0, 0),
(118, '1318f14', '3', '', '2014-10-15 18:54:44', 0, 0),
(119, '1318f14', '4', '', '2014-10-15 18:54:44', 0, 0),
(120, '1318f14', '30', '', '2014-10-15 18:54:44', 0, 0),
(121, '1318f14', '5', '', '2014-10-15 18:54:44', 0, 0),
(122, '34d7d38', '86', '3 HNVGOs in the previous 6 months', '2014-11-05 21:31:10', 0, 0),
(123, '34d7d38', '84', 'flying a lot', '2014-11-05 21:31:10', 0, 0),
(124, '34d7d38', '91', '123.025', '2014-11-05 21:31:10', 0, 0),
(125, '34d7d38', '87', 'Another person on NVGs', '2014-11-05 21:31:10', 0, 0),
(126, '34d7d38', '95', '5 miles', '2014-11-05 21:31:10', 0, 0),
(127, '34d7d38', '31', 'losing your certificate', '2014-11-05 21:31:10', 0, 0),
(128, '34d7d38', '32', '1 year', '2014-11-05 21:31:10', 0, 0),
(129, '34d7d38', '33', '30 days', '2014-11-05 21:31:10', 0, 0),
(130, '34d7d38', '38', 'everything', '2014-11-05 21:31:10', 0, 0),
(131, '34d7d38', '45', 'don''t land', '2014-11-05 21:31:10', 0, 0),
(132, '34d7d38', '56', 'no', '2014-11-05 21:31:10', 0, 0),
(133, '34d7d38', '52', 'when it is dead', '2014-11-05 21:31:10', 0, 0),
(134, '34d7d38', '63', 'no', '2014-11-05 21:31:10', 0, 0),
(135, '34d7d38', '67', 'sleeping', '2014-11-05 21:31:10', 0, 0),
(136, '34d7d38', '59', 'how to wear a seatbelt', '2014-11-05 21:31:10', 0, 0),
(137, '34d7d38', '65', '8 hours', '2014-11-05 21:31:10', 0, 0),
(138, '34d7d38', '72', 'no', '2014-11-05 21:31:10', 0, 0),
(139, '34d7d38', '71', '6 hnvgos in the previous 2 calendar months', '2014-11-05 21:31:10', 0, 0),
(140, '34d7d38', '70', '40 degrees', '2014-11-05 21:31:10', 0, 0),
(141, '34d7d38', '75', 'who knows', '2014-11-05 21:31:10', 0, 0),
(142, '34d7d38', '82', 'yes', '2014-11-05 21:31:10', 0, 0),
(143, '34d7d38', '78', 'nothing', '2014-11-05 21:31:10', 0, 0),
(144, '34d7d38', '98', 'yes', '2014-11-05 21:31:10', 0, 0),
(145, 'f554748', '85', 'moo', '2014-11-11 16:17:09', 0, 0),
(146, 'f554748', '92', 'snake', '2014-11-11 16:17:09', 0, 0),
(147, 'f554748', '96', 'cat', '2014-11-11 16:17:09', 0, 0),
(148, 'f554748', '90', 'cat', '2014-11-11 16:17:09', 0, 0),
(149, 'f554748', '94', 'Lion', '2014-11-11 16:17:09', 0, 0),
(150, 'f554748', '1', 'cat', '2014-11-11 16:17:09', 0, 0),
(151, 'f554748', '31', 'cat', '2014-11-11 16:17:09', 0, 0),
(152, 'f554748', '34', 'cat', '2014-11-11 16:17:09', 0, 0),
(153, 'f554748', '50', 'cat', '2014-11-11 16:17:09', 0, 0),
(154, 'f554748', '69', 'cat', '2014-11-11 16:17:09', 0, 0),
(155, 'f554748', '72', 'cat', '2014-11-11 16:17:09', 0, 0),
(156, 'cbb7afd', '94', 'dog', '2014-12-09 23:40:36', 0, 0),
(157, 'cbb7afd', '33', 'cat', '2014-12-09 23:40:36', 0, 0),
(158, 'cbb7afd', '41', 'dog2', '2014-12-09 23:40:36', 0, 0),
(159, 'fb74a5a', '86', 'a', '2016-03-02 15:11:16', 0, 0),
(160, 'fb74a5a', '96', 'b', '2016-03-02 15:11:16', 0, 0),
(161, 'fb74a5a', '92', 'v', '2016-03-02 15:11:16', 0, 0),
(162, 'fb74a5a', '1', 'q', '2016-03-02 15:11:16', 0, 0),
(163, 'fb74a5a', '33', 'u', '2016-03-02 15:11:16', 0, 0),
(164, 'fb74a5a', '44', 'o', '2016-03-02 15:11:16', 0, 0),
(165, 'fb74a5a', '41', 'l', '2016-03-02 15:11:16', 0, 0),
(166, 'fb74a5a', '43', 'a', '2016-03-02 15:11:16', 0, 0),
(167, 'fb74a5a', '38', 'g', '2016-03-02 15:11:16', 0, 0),
(168, 'fb74a5a', '65', 't', '2016-03-02 15:11:16', 0, 0),
(169, 'fb74a5a', '60', 'p', '2016-03-02 15:11:16', 0, 0),
(170, 'fb74a5a', '61', 'g', '2016-03-02 15:11:16', 0, 0),
(171, '04481de', '96', '', '2018-05-10 21:43:59', 0, 0),
(172, '04481de', '97', '', '2018-05-10 21:43:59', 0, 0),
(173, '04481de', '87', '', '2018-05-10 21:43:59', 0, 0),
(174, '04481de', '33', '', '2018-05-10 21:43:59', 0, 0),
(175, '04481de', '32', '', '2018-05-10 21:43:59', 0, 0),
(176, '04481de', '1', '', '2018-05-10 21:43:59', 0, 0),
(177, '04481de', '46', '', '2018-05-10 21:43:59', 0, 0),
(178, '04481de', '45', '', '2018-05-10 21:43:59', 0, 0),
(179, '04481de', '61', '', '2018-05-10 21:43:59', 0, 0),
(180, '04481de', '65', '', '2018-05-10 21:43:59', 0, 0),
(181, '04481de', '66', '', '2018-05-10 21:43:59', 0, 0),
(182, '04481de', '72', '', '2018-05-10 21:43:59', 0, 0),
(183, '04481de', '74', '', '2018-05-10 21:43:59', 0, 0),
(184, '04481de', '76', '', '2018-05-10 21:43:59', 0, 0),
(185, '04481de', '78', '', '2018-05-10 21:43:59', 0, 0),
(186, '04481de', '77', '', '2018-05-10 21:43:59', 0, 0),
(187, '04481de', '98', '', '2018-05-10 21:43:59', 0, 0),
(188, '643af0b', '94', '1', '2018-05-10 21:45:47', 0, 0),
(189, '643af0b', '90', '3', '2018-05-10 21:45:47', 0, 0),
(190, '643af0b', '31', '4', '2018-05-10 21:45:47', 0, 0),
(191, '643af0b', '33', '4', '2018-05-10 21:45:47', 0, 0),
(192, '643af0b', '48', '', '2018-05-10 21:45:47', 0, 0),
(193, '643af0b', '55', '7', '2018-05-10 21:45:47', 0, 0),
(194, '643af0b', '57', '7', '2018-05-10 21:45:47', 0, 0),
(195, '643af0b', '68', '55', '2018-05-10 21:45:47', 0, 0),
(196, '643af0b', '74', '', '2018-05-10 21:45:47', 0, 0),
(197, '643af0b', '75', '', '2018-05-10 21:45:47', 0, 0),
(198, '643af0b', '80', '', '2018-05-10 21:45:47', 0, 0),
(199, '643af0b', '82', '', '2018-05-10 21:45:47', 0, 0),
(200, '643af0b', '77', '', '2018-05-10 21:45:47', 0, 0),
(201, '643af0b', '99', '', '2018-05-10 21:45:47', 0, 0);
