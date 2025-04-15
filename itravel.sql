-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(3) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_mobile` varchar(14) NOT NULL,
  `admin_dob` date NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_role` enum('super admin','admin') DEFAULT 'admin',
  `admin_doj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_dob`, `admin_password`, `admin_role`, `admin_doj`) VALUES
(5, 'Dabhi Jitendra', 'jitt@gmail.com', '565956', '2001-10-12', '$2y$10$si/Yo6XdRvHfvIjOMVmpSegzohQuCFs5yKDLliGKfgUe1vpBO1KNC', 'super admin', '2025-04-03 19:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `booking_table`
--

CREATE TABLE `booking_table` (
  `booking_id` int(3) NOT NULL,
  `package_id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `departure_date` date DEFAULT NULL,
  `num_adults` int(3) DEFAULT NULL,
  `num_children` int(3) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `gst_amount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','Paid') DEFAULT 'pending',
  `payment_method` enum('Credit Card','Bank Transfer','UPI','Cash') DEFAULT NULL,
  `booking_status` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_table`
--

INSERT INTO `booking_table` (`booking_id`, `package_id`, `name`, `email`, `phone`, `booking_date`, `departure_date`, `num_adults`, `num_children`, `total_amount`, `gst_amount`, `grand_total`, `payment_status`, `payment_method`, `booking_status`, `created_at`) VALUES
(45, 28, 'jitt', 'dabhijitendra5927@gmail.com', '7490941144', '2025-04-14', '2025-01-14', 4, 1, 135000.00, 24300.00, 159300.00, 'Paid', 'Credit Card', 'Pending', '2025-04-13 22:11:24'),
(46, 38, 'Parth', 'dabhijitendra5927@gmail.com', '66552655', '2025-04-14', '2025-07-14', 8, 2, 240000.00, 43200.00, 283200.00, 'Paid', 'Bank Transfer', 'Pending', '2025-04-14 10:20:49'),
(48, 28, 'Dabhi Jitendra', 'dabhijitendra5927@gmail.com', '7490941144', '2025-04-14', '2025-01-14', 3, 2, 130000.00, 23400.00, 153400.00, 'Paid', 'Bank Transfer', 'Pending', '2025-04-14 20:06:17'),
(49, 29, 'Dabhi Jitendra', 'jitt1@gmail.com', '1255566', '2025-04-15', '2025-12-12', 2, 1, 12200.00, 2196.00, 14396.00, 'Paid', 'Credit Card', 'Pending', '2025-04-15 05:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`) VALUES
(1, 'Adventure'),
(3, 'Hill station'),
(4, 'Beaches'),
(5, 'Honeymoon'),
(6, 'Wildscape'),
(8, 'Religious'),
(9, 'City tour');

-- --------------------------------------------------------

--
-- Table structure for table `contact_table`
--

CREATE TABLE `contact_table` (
  `contact_id` int(3) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `contact_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_table`
--

INSERT INTO `contact_table` (`contact_id`, `user_name`, `user_email`, `subject`, `contact_date`) VALUES
(10, 'Dabhi Jitendra', 'dabhijitendra5927@gmail.com', 'i want to book tour package', '2025-04-15 01:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `departure_dates`
--

CREATE TABLE `departure_dates` (
  `depart_id` int(3) NOT NULL,
  `package_id` int(3) DEFAULT NULL,
  `departure_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departure_dates`
--

INSERT INTO `departure_dates` (`depart_id`, `package_id`, `departure_date`) VALUES
(21, 27, '2025-10-12'),
(22, 27, '2025-11-10'),
(23, 27, '2026-01-01'),
(24, 28, '2025-12-12'),
(25, 28, '2025-01-14'),
(26, 29, '2025-12-12'),
(27, 30, '2026-01-21'),
(28, 30, '2025-12-29'),
(29, 31, '2025-05-01'),
(30, 31, '2025-02-23'),
(31, 32, '2025-06-26'),
(32, 32, '2025-07-12'),
(33, 33, '2025-07-05'),
(34, 33, '2025-07-04'),
(35, 34, '2025-07-17'),
(36, 34, '2025-09-19'),
(37, 35, '2026-02-10'),
(38, 35, '2026-01-05'),
(39, 35, '2025-11-08'),
(40, 36, '2025-05-15'),
(41, 36, '2025-07-24'),
(42, 37, '2025-07-10'),
(43, 38, '2025-08-15'),
(44, 38, '2025-06-16'),
(45, 38, '2025-07-14'),
(46, 39, '2025-05-12'),
(47, 39, '2025-05-24'),
(48, 39, '2025-06-20'),
(49, 40, '2025-05-14'),
(50, 40, '2025-04-29'),
(51, 41, '2025-04-20'),
(52, 41, '2025-05-01'),
(53, 41, '2025-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `destination_table`
--

CREATE TABLE `destination_table` (
  `destination_id` int(3) NOT NULL,
  `destination_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_table`
--

INSERT INTO `destination_table` (`destination_id`, `destination_name`) VALUES
(20, 'Amritsar'),
(9, 'Chennai'),
(15, 'Dehradun'),
(42, 'Dharmshala'),
(22, 'Diu'),
(8, 'Dwarka'),
(16, 'Gangtok'),
(7, 'Gir'),
(21, 'Goa'),
(24, 'Gulmarg'),
(26, 'Havelock Island'),
(44, 'Jaipur'),
(12, 'Kargil'),
(25, 'Kashmir'),
(23, 'Katra'),
(17, 'Lachung'),
(13, 'Leh'),
(19, 'Manali'),
(14, 'Sankri'),
(41, 'Saputara'),
(18, 'Shimla'),
(6, 'Srinagar'),
(10, 'Tirupati'),
(46, 'Udaipur'),
(43, 'West bangal');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `feedback_id` int(4) NOT NULL,
  `username` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `feedback_message` varchar(200) NOT NULL,
  `feedback_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reply_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`feedback_id`, `username`, `user_email`, `feedback_message`, `feedback_date`, `reply_message`) VALUES
(26, 'Dabhi Jitendra', 'dabhijitendra5927@gmail.com', 'good experience to book tour ', '2025-04-15 01:34:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_table`
--

CREATE TABLE `hotel_table` (
  `hotel_id` int(3) NOT NULL,
  `hotel_name` varchar(25) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `destination` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_table`
--

INSERT INTO `hotel_table` (`hotel_id`, `hotel_name`, `address`, `image_url`, `description`, `destination`) VALUES
(12, 'Hotel Royal Batoo', 'Khayam Chowk Dalgate, Srinagar, 190001 , India', 'royal2.jfif', 'Stay With Us and Feel Like at home Hotel Royal Batoo offers unique styling and a personalized service in the heart of Srinagar City. The Newest luxury Hotel with 80 rooms as inventory in Srinagar Kashmir is centrally located, around 1 km from Tourist Reception Centre and few steps away from Dal Lake. The Hotel is located 12 kms from Srinagar Sheikh ul Alam International Airport. We are also within heart of city as some of the best shopping outside as well as a profusion of restaurant including our own Multi-cuisine Restaurant. ', 'Srinagar'),
(13, 'Hotel Siachen', '\r\nMain Bazaar, Kargil , 194103 , India', 'siachen1.jfif', 'Siachen Hotel is situated in Kargil. It takes pride in offering its guests a peaceful and tranquil heaven. The hotel is a perfect retreat for visitors and business travelers. It offers Wi-Fi, laundry, doctor on call, travel counter and many more. The warm and supportive staff ensures any and every whim is met at the earliest. The rooms are luxuriously well decorated and furnished to give maximum comforts to the guests.', 'Kargil'),
(14, 'Himalayan Eco Resort', 'Village Hunder, Hunder 194401 India', 'royallachung2.jfif', 'Himalayan Eco Resort is situated in the picturesque village of Hunder in Nubra Valley, located 124 kms north of Leh. Himalayan Eco Resort and Camp is an eco-friendly resort comprising 20 private and independent luxury cottages and 05 deluxe tents, each affording a grand view of the snow-clad mountains, located amidst the vibrant woodlands and majestic plantations of poplar, willow, apple.', 'Leh'),
(15, 'Mahima Hotel', 'Kamru 172106 ,Sankri,India', 'mahima.jpeg', ' Mahima is located in Sāngla. Featuring room service, this property also provides guests with a restaurant. All units in the hotel are equipped with a flat-screen TV.', 'Sankri'),
(16, 'Hotel Ashrey', '10,Tyagi Road, Near Dehradun Railway Station, 248001 Dehradun, India', 'ashrey1.jpeg', 'Set in Dehradun, 27 km from Gun Hill Point, Mussorie, Hotel Ashrey offers accommodation with free bikes, free private parking, a fitness centre and a garden. This 2-star hotel offers a shared lounge and room service. The accommodation features a 24-hour front desk, airport transfers, a kids club and free WiFi throughout the property. The hotel comes with a flat-screen TV with satellite channels, a kitchen, a dining area, a safety deposit box and a private bathroom with a bidet, free toiletries and a hairdryer. At Hotel Ashrey every room includes bed linen and towels. Breakfast is available every morning, and includes à la carte, continental and Full English/Irish options.', 'Dehradun'),
(17, 'Hotel Sikkim Delight', 'Manbir Colony, Indira Bye Pass Near Helipad, Gangtok 737101 India', 'sikkim.jfif', 'Hotel Sikkim Delight is located on the outskirts of Gangtok, the capital city of Sikkim. It is away from the hullabaloo of the market area and provides the serenity and tranquility that are a commonplace with the countryside. The hotel offers 20 guest rooms and an elegant fine dining restaurant.', 'Gangtok'),
(18, 'Royal Lachung', 'Near Police Station, Lachung 737120 India', 'royal.jfif', 'Delight Royal Lachung is a pure veg hotel with ostentatious and extravagant to the very core. Majestic facade, elegant interiors, opulent furnishings and an ultimate service, all make the hotel a favourite with visitors to the valley. With its well decorated rooms, the hotel has a lot to offer to its guests. Each room comes fitted with the best of amenities and facilities.', 'Lachung'),
(19, 'Amara Hotels and Resorts', 'Amara Resorts Manali Thakur Dass Village, Dhamsu, P.O. Karjan, shimla- Manali Rd, 175136', 'amara.jpg', 'et in Manāli, 14 km from Hidimba Devi Temple, Amara Resorts Manali offers accommodation with a garden, free private parking and a restaurant. Among the facilities at this property are room service and a 24-hour front desk, along with free WiFi throughout the property. The resort features garden views and a childrens playground. All guest rooms at the resort come with a seating area, a flat-screen TV with satellite channels and a private bathroom with free toiletries and a shower', 'Shimla'),
(20, 'Mohan Palace', 'Left Bank, Naggar Road, Aleo, Manali India.', 'mohan.jpg', 'Hotel Mohan Palace is an excellent choice for travellers visiting Manali, offering a romantic environment alongside many helpful amenities designed to enhance your stay. The rooms offer a flat screen TV, allowing you to rest and refresh with ease. Hotel Mohan Palace features 24 hour front desk, room service, and a concierge. In addition, as a valued Hotel Mohan Palace guest, you can enjoy an on-site restaurant that is available on-site.', 'Manali'),
(21, 'Treehouse London', '84, Queens Road Near Railway Station, Railway Station, Amritsar, Punjab 143001', 'tree.jpeg', ' Centrally located in the heart of the bustling Amritsar in Punjab, the 34 rooms Treehouse London Street is perfect place to stay for both a busy business and a leisure traveller to the city of Amritsar. The Hotel which was opened in 2020 is nicely done up providing all the amenities that our busy guests require for their comfortable stay. With close proximity to important landmarks like Golden Temple, District Court, Guru Gobindgarh Fort, Local Market, Airport, Railway Station and many other landmarks which define Amritsar, Treehouse London Street has in a short span of time has become a preferred choice for travellers to Amritsar.', 'Amritsar'),
(22, 'Zone Connect,Calangute', ' H. No. 2/16 A, Naika Vaddo, Calangute, Goa 403516', 'zoneconnect.jpg', 'Zone Connect Calangute is located in Goa Velha in the Goa region, 1.2 km from Calangute Beach and 1.2 km from Candolim Beach. Providing a restaurant, the property also has a bar, as well as an indoor pool. The accommodation provides a 24-hour front desk and room service for guests. The hotel will provide guests with air-conditioned rooms with a wardrobe, a kettle, a fridge, a minibar, a safety deposit box, a flat-screen TV and a private bathroom with a shower.Guests at Zone Connect Calangute can enjoy a continental breakfast. You can play billiards at the accommodation, and car hire is available. Baga Beach is 2.2 km from Zone Connect Calangute. The nearest airport is Dabolim, 18 km from the hotel, and the property offers a paid airport shuttle service.', 'Goa'),
(23, ' Royal Orchid Beach Resor', 'Uttorda Beach Salcette, Utorda 403713 India', 'orchid.jpeg', 'Royal Orchid Beach Resort & Spa offers 5-star beachfront accommodation with pool or tropical garden views. It features a large pool with sunken bar, fitness centre and restaurant with sea views.Modern rooms feature dark wood furnishings and flat-screen cable TVs. They are equipped with a safe and ironing facilities. The attached bathrooms feature glass walls, a bathtub and hairdryer.Guests can indulge in massages at Sohum Spa. For those looking to exercise, tennis courts and a well-equipped fitness centre are available. Activities such as beach volley ball, box cricket and football are offered. The property also has a games room.', 'Goa'),
(24, 'Hotel The Grand Highness', ' Main Bazar Near Hotel Prince, Diu, Diu Island 362520 India', 'highness.jpeg', ' Everyone needs a place to lay their weary head. For travelers visiting Diu, Hotel The Grand Highness is an excellent choice for rest and rejuvenation. Well-known for its luxury environment and proximity to great restaurants and attractions, Hotel The Grand Highness makes it easy to enjoy the best of Diu. As your home away from home, the hotel rooms offer a refrigerator, air conditioning, and extra long beds, and getting online is easy, with free wifi available. Guests have access to room service while staying at Hotel The Grand Highness', 'Diu'),
(25, 'Hotel Devi Grand', 'Reasi Road Near Katra Toll Barrier, Katra 182301 India', 'devi.jfif', ' Hotel Devi Grand in Katra is an ideal choice of stay for business and leisure travelers, offering fine services at budget rates. Maintained by a skilled and friendly staff, Hotel Devi Grand ensures you have a good facilitating Area, Complimentary Veg Breakfast, In-house Restaurant and more are equipped in our property.First aid, round the clock security and fire safety are provided to our guests for their safety. To provide further assistance to our guests, we have a 24-hour help desk on our property.', 'Katra'),
(26, 'The Rose Wood', ' Reservoir Road, Gulmarg 193403 India', 'rosewood.jfif', 'If you are looking for a luxury hotel in Gulmarg, look no further than The Rosewood. Close to Rani Temple (2.4 mi), a popular Gulmarg landmark, The Rosewood is a great destination for tourists. As your home away from home, the hotel rooms offer a flat screen TV, air conditioning, and a refrigerator, and getting online is easy, with free wifi available. Guests have access to a concierge and room service while staying at The Rosewood. In addition, The Rosewood offers breakfast, which will help make your Gulmarg trip additionally gratifying. And, as an added convenience, there is free parking available to guests. ', 'Gulmarg'),
(27, 'Hotel Mount View', 'Club Road Near SBI Bus Station, Dalhousie 176304 India', 'mount.jfif', 'Hotel Mount View and Dalhousie are dramatically intertwined. This hotel is Dalhousies first landmark. For more than a century, Today its a number one hotel in Dalhousie and favourite destination for discerning travellers. The hotel is being constantly renovated, refurbished and modernised, it is Centrally Air Conditioned and Offers The Best Exteriors And Great Interiors Our Terraces, Landscaped Gardens, Water Bodies, Public Areas, Lobby, The Kettle House Restaurant And Cedar Restaurant, Gabfest Conferences Anandam Spa, Bodywise Fitness Studio, Freebees Gameszone, Kids Junction, Jumanji Children Park, Local Folk Singer Evenings Tambola, Games, Covered And Safe Parking etc.', 'Kashmir'),
(28, 'Sea Shell Resort & Spa', 'No - 02 Govind Nagar Beach, Swaraj Dweep, Havelock Island 744211 India', 'seashell.jpg', ' Our beach side resort provides an excellent view of the clear emerald waters and coconut trees studded beach. Its well-appointed suites with modern amenities, warm and welcoming staff ensure that guests are comfortable and cared for. Dining options include our all-day dining Urban Tadka which serves a multi-cuisine fare.Our bar gives you splendid view of the sea with the mouth smashing mocktails, cocktails and flavorsome seafood. With well trained staff manning the kids play zone, couples can relax and enjoy the serene beauty of the resort, or indulge in some spa therapy or choose our in house scuba diving centre to explore the ocean. With the swimming pool having a kids pool and a Jacuzzi, you are bound to have a memorable and fun time with your family at SeaShell.', 'Havelock Island'),
(29, 'Silver Sand Village Resor', 'Kalapathar Village, Havelock Island 744211 India', 'silver.jpg', 'This self contained village style resort is an architectural ode to the motherland of Andaman and Nicobar Islands. Situated on the paradise Island of Havelock (Now Swaraj Deep Island), the resort is walking distance to the beautiful and stoic Kalapathar Beach. The resort plays a homage to the colours, culture, flavours and lifestyle of the villages and farmlands that surrounds it.', 'Havelock Island'),
(31, 'The Fern Gir Forest Resor', ' Sh - 26 Sasan Road, Sasan Gir, Gir National Park 362135 India', 'fern.jpeg', ' Nestled by the thick vegetation, picturesque hills, green fields, beautiful landscaped gardens and adjacent to Gir Lion Sanctuary, The Fern Gir Forest Resort is regarded as one of the best forest hotels in India. Enjoy a relaxing holiday with family & friends at one of the best hotels in Gir. A stay at our hotel in Gir guarantees you a memorable holiday.Being amongst the leading hotels in Gir this Fern resort, a Unit of Kotecha hotels and Managed by Concept Hospitality Pvt. Ltd. offers a total of 40 well appointed and aesthetically designed rooms comprising of suites, villas, cottages & luxury tents that exude opulence and style.', 'Gir'),
(32, 'Dwarkadhish Lords Eco Inn', ' Near Gayatri Temple, Dwarka 361335 India', 'dwarka1.jpeg', ' Hotel has graciously appointed rooms with state of art modern facilities & amenities for utmost guest comfort. The only Sea facing and branded hotel at walking distance from Dwarkadhish Temple.', 'Dwarka'),
(33, 'Lemon Tree Premier', ' Nageshwar Rd, Near Iskon Gate, Dwarka 361335 India', 'lemontree1.jpeg', ' Lemon Tree Premier, Dwarka is strategically situated adjacent to the Iskon gate, which is just a kilometre from the magnificent Dwarkadhish Temple. The hotel features 109 well-appointed rooms and suites, which combine understated elegance and old world charm with modern amenities and facilities.', 'Dwarka'),
(34, 'The Park Chennai', '601 Anna Salai, Chennai (Madras) 600006 India', 'parkchennai.jfif', 'The Park Chennai is in the heart of the citys vibrant business district. The hotels decor is influenced by the very foundation it stands on – the former premises of Gemini Film Studios, renowned for producing some of the most influential heroes and heroines the country has known. The dining and bar facilities at this hotel are amongst the best that the city offers. Six-O-One, the hotels 24 hour offers a mix of Indian and International cuisine while the Leather bar and Pasha are perfect options for elite party-goers.', 'Chennai'),
(35, 'Renest Tirupati', ' 18-8-40/B, Tirumula Bypass Road Leela Mahal Centre, Tirupati 517501 India', 'renest.jpeg', 'Renest Tirupati 61 state of the art rooms incorporate carefully selected colors and fabrics to create four unique themes: At Home, Chic, Fashion and Fresh. Featuring an elegant color palette of creams, golds and browns, the classy Superior View Rooms create an atmosphere of tranquility; these rooms are the perfect mix of business and pleasure.', 'Tirupati'),
(36, 'Hotel Trinity Heights', 'Mcleod Ganj, Dharamshala | 110 m from Bhagsunag Temple', 'trinity.jfif', ' Nestled amidst the snow-capped mountains, this opulent property features comfortable rooms, a lavish restaurant and a host of modern amenities. Witness the captivating views of the snow-capped mountains from the comfort of your room. Enjoy the propertys close proximity to Bhagsunag Waterfall which is 850 m away. Its in-house multi-cuisine restaurant & bar serves a wide range of delectables and caters to all sorts of food and drinks cravings.', 'Dharmshala'),
(37, 'Hotel Royal Orchid', 'Opposite BSNL Office Near Durgapura Flyover, Tonk Road, Jaipur 302018 India', 'orchid1.jpeg', 'Strategically located just 2.5 Kms from Jaipur airport and 10 kms from the city railway station, Hotel Royal Orchid with its elegant furnishing, decor and blend of sophistication, flamboyance with a relaxed attitude make this an ideal stay for all discerning travellers with free WI-FI. The guests can calm their senses at the roof-top swimming pool or indulge in gastronomic delights at Tiger Trail and at the 24 hour coffee shop Limelight and can even lighten their spirit at Salsa- the signature lounge bar after a day of hectic bustle.', 'Jaipur'),
(38, 'Hotel Udai Palace', ' 11 - Agrasen Nagar Opp. Central Bus Stand, Udaipur 313001 India', 'udai1.jpeg', 'Welcome and Greetings to you and your dear-self, from Udai Palace Hotel. We are here for you since 2007 to provide you with The Best of the Hospitality services. Though in our overall journey, we initially had only 2 Floors with 17 Rooms, which later developed to overall 3floor with 24Rooms. And in 2011 through the grace of our guest and clients, we built up 4floors with 30 Rooms property. This happened by the intermingling of your trust and our vision to provide a contented and hassle free excursion to Udaipur city.', 'Udaipur');

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `pimg_id` int(3) NOT NULL,
  `package_id` int(3) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`pimg_id`, `package_id`, `image_path`) VALUES
(14, 28, 'uploads/package/l1.jpeg'),
(15, 28, 'uploads/package/l2.jpg'),
(16, 28, 'uploads/package/l3.jpg'),
(17, 28, 'uploads/package/l4.jpg'),
(18, 28, 'uploads/package/l5.jpg'),
(19, 29, 'uploads/package/saputara.jpeg'),
(21, 30, 'uploads/package/k1.jpeg'),
(22, 30, 'uploads/package/k2.jpeg'),
(23, 30, 'uploads/package/k3.jpeg'),
(24, 30, 'uploads/package/k4.jpeg'),
(25, 30, 'uploads/package/k5.jpeg'),
(26, 31, 'uploads/package/goa1.jpeg'),
(27, 31, 'uploads/package/goa3.jpg'),
(28, 31, 'uploads/package/goa4.jpg'),
(29, 31, 'uploads/package/goa5.jpeg'),
(31, 32, 'uploads/package/goa2.jpeg'),
(32, 32, 'uploads/package/goa3.jpg'),
(33, 32, 'uploads/package/goa4.jpg'),
(34, 32, 'uploads/package/goa5.jpeg'),
(35, 33, 'uploads/package/diu1.jpg'),
(36, 33, 'uploads/package/diu2.jpg'),
(37, 33, 'uploads/package/diu3.jpg'),
(38, 33, 'uploads/package/diu4.jpeg'),
(39, 34, 'uploads/package/sikkim1.jpg'),
(40, 34, 'uploads/package/sikkim2.jpg'),
(41, 34, 'uploads/package/sikkim3.jpeg'),
(42, 34, 'uploads/package/sikkim4.jpg'),
(43, 34, 'uploads/package/sikkim5.jpg'),
(44, 35, 'uploads/package/himachal1.jpg'),
(45, 35, 'uploads/package/himachal2.jpeg'),
(46, 35, 'uploads/package/himachal3.jpg'),
(47, 35, 'uploads/package/himachal4.jpeg'),
(48, 35, 'uploads/package/himachal5.jpg'),
(49, 36, 'uploads/package/gir1.png'),
(50, 36, 'uploads/package/gir2.jpg'),
(51, 36, 'uploads/package/gir3.jpg'),
(52, 36, 'uploads/package/gir4.jpg'),
(53, 37, 'uploads/package/sun1.jpg'),
(54, 37, 'uploads/package/sun2.jpg'),
(55, 37, 'uploads/package/sun3.jpg'),
(56, 37, 'uploads/package/sun4.jpg'),
(57, 37, 'uploads/package/sun5.jpg'),
(58, 38, 'uploads/package/tirupati1.jpg'),
(59, 38, 'uploads/package/tirupati2.jpeg'),
(60, 38, 'uploads/package/tirupati3.jpg'),
(61, 38, 'uploads/package/tirupati4.jpg'),
(62, 38, 'uploads/package/tirupati5.jpg'),
(63, 39, 'uploads/package/gujarat3.jpg'),
(64, 40, 'uploads/package/jaipur1.jpg'),
(65, 40, 'uploads/package/jaipur3.jpeg'),
(66, 40, 'uploads/package/jaipur4.jpg'),
(67, 40, 'uploads/package/jaipur5.jpg'),
(68, 40, 'uploads/package/japiur2.jpg'),
(69, 41, 'uploads/package/udai1.jpg'),
(70, 41, 'uploads/package/udai2.jpg'),
(71, 41, 'uploads/package/udai3.jpg'),
(72, 41, 'uploads/package/udai4.jpg'),
(73, 41, 'uploads/package/udai5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `package_table`
--

CREATE TABLE `package_table` (
  `package_id` int(3) NOT NULL,
  `package_name` varchar(30) NOT NULL,
  `package_details` varchar(5000) NOT NULL,
  `adult_price` int(7) DEFAULT NULL,
  `child_price` int(7) DEFAULT NULL,
  `days` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_table`
--

INSERT INTO `package_table` (`package_id`, `package_name`, `package_details`, `adult_price`, `child_price`, `days`, `status`, `category_id`) VALUES
(28, 'Magical Ladakh', 'Where the mountains meet the sky.Not just a place, it’s a feeling.Far away from the commotion of the city, lies a land that is unspoiled and pristine.A paradise for hikers and nature lovers', 28000, 23000, '6', 'active', 1),
(29, 'Saputara Trekking Camp', 'Gujarat Ki Ankh Ka Tara: Saputara Saputara Hill Station is perched at an altitude of about 1000 metres in the Sahyadri Mountain ranges. Its verdant forests, pristine lakes, and spectacular waterfalls create an illusion of heaven on earth. Though Saputara is beautiful throughout the year, its beauty scales new heights during the monsoon season. Saputara in the rains, is an experience that is nothing short of a revelation.', 5000, 2200, '3', 'Active', 1),
(30, 'Paradise on Earth(Kashmir)', 'If there is heaven on earth.. It is here!! The valley, the mountains and the river – everything about the stunning land continue to elevate its beauty at all the junctions throwing new surprises.The beauty of the Kashmir Valley is beyond description', 35000, 0, '5', 'active', 5),
(31, 'Honeymoon Delight(Goa)', 'Behold the breathtaking landscape views to ancient Churches, bustling beaches and striking nightlife of the smallest state in India, Goa.Experience soul-stirring water adventures like Jetski, Banana Ride, Bumper Ride, Parasailing and Boat Ride.Stroll bare feet on the golden beaches to witness the sun gently splashes its golden lights as it sets over the horizon.', 30000, 0, '6', 'active', 5),
(32, 'Pearl of the Orient(Goa)', 'Explore Goa as never before . Behold the breathtaking landscape views to ancient Churches, bustling beaches and striking nightlife of the smallest state in India, Goa.Experience soul-stirring water adventures like Jetski, Banana Ride, Bumper Ride, Parasailing and Boat Ride.Stroll bare feet on the golden beaches to witness the sun gently splashes its golden lights as it sets over the horizon.\r\n', 25000, 15000, '3', 'active', 4),
(33, 'Dazzling Diu', 'Visit one of the most renowned coastal towns at the eastern end of Diu Island. Explore the rich historical architecture of the 13th century as you stroll through the major attractions of the town. Immerse in the influence of Portuguese culture while relishing in the authentic cuisine of the island. Known for its pristine beaches, significant monuments, and vibrant nightlife of the town one can admire the Diu Fort, and the 16th-century Portuguese citadel. The other prominent attractions are the lighthouse, cannons, and centuries-old St. Pauls Church, built in an elaborate baroque style.', 12000, 8000, '3', 'Active', 4),
(34, 'Treasures of Sikkim', 'Where Nature Smiles and we now know why! Sikkim tourism is known for Small but Beautiful.The state is known for its stunning natural beauty, from its lush green valleys to its snow-capped mountains. It is also home to a vast array of wildlife,including the snow leopard and red panda. In addition to its natural attractions, Sikkim also has a rich cultural heritage, with a variety of ethnic groups living in the region.\r\n', 25000, 20000, '7', 'Active', 3),
(35, 'Heavenly Himachal', 'A destination for all seasons and all reasons. Best Place for Flora & Fauna , Fairs & Fests , Cuisine , Adventure , Culture & Heritage.', 25000, 18000, '8', 'Active', 3),
(36, 'Glimpse Of Gir', 'Gir forest has several species to adore and see while staying there. The speciality of this forest is that it not only amazes the tourist with its serene beauty but also it provides an unforgettable memory for the people. This special package of Gir includes 2 Nights of amazing stay and 3 days to you with a 1-day jeep safari included.', 5000, 3000, '3', 'Active', 6),
(37, 'Sunderban wildescapes', 'In Sundarban National Park in West Bengal, the tiger makes his round with an unmatched stealth and grace. The air feels wet and damp, while the silence is interrupted by the melodious singing of birds and roar of motor boats.the mangrove trees stand lazily on the mudflats, which are visible during low tides, and submerged in height tide. Its name means beautiful forests in the local language. Another reasons are the Sundari trees, which are dominant in this mangrove area. Their uniqueness lies in their roots which shoot upwards for respiration, particularly during waterlogging during monsoons.The best time to visit Sunderbans is between November to March. The weather is quite pleasant during this time and creates the perfect conditions for tiger sighting and other wildlife.\r\nP', 12000, 7000, '2', 'Active', 6),
(38, 'Tirupati Balaji Tour', 'Boasting a great spiritual importance among the Hindu devotees, Tirupati Balaji is one of the holiest and most frequented religious spots in India. Present as an abode of Lord Venkateshwara, an incretion of Lord Vishnu, this temple is popular as Vaikuntam on the earth. A horde of spiritual travelers swarms this place every year to drench themselves in utter spirituality and serenity. Thousands of devotees visit this temple everyday to pay homage to the utmost power. This 03 nights and 04 days itinerary is a comprehensive schedule for the travelers who want to visit the epicentre of Hindu spirituality. This tour is perfect for the travelers who want to accomplish their wishes and wash away their sins in a destination sacrosanct and divine.', 25000, 20000, '4', 'Active', 8),
(39, 'Kingdom of Krishna - Dwarka', 'Dwarka is Kingdom of Shree Krishna. its beautiful religious place for Hindus. and its includes with 4 dhamyatra also.\r\n', 8000, 5000, '2', 'Active', 8),
(40, 'Pink City Jaipur', 'The marvellous and magnificent city, Jaipur which is also the capital of the historical and traditional state of Rajasthan. Jaipur is finely decorated with bright brimming colours, mesmerizing, grandiose and enchanting forts and the all lively and soothing lifestyle. Also known as the Pink City; a title it earned during early times due to the gorgeous and the glittering Hawa Mahal, the place has a strong allure intermingled with the essence of it. Everything in the city is going to compel you into mindfulness and enthralling time of your life.', 15000, 10000, '3', 'Active', 9),
(41, 'Blue City Udaipur', 'One of the best weekend package in Rajasthan is Udaipur city. Udaipur is one of the most beautiful cities in India, and its no wonder that its a popular tourist destination. The beauty of Udaipur is truly breathtaking. The palaces of Udaipur are a true testament to the rich history of India. Udaipur, is also known as the Venice of the East. the city of lakes Udaipur is located around azure water lakes and is hemmed in by lush green hills of Aravallis. The famous Lake Palace, located in the middle of Lake Pichola is one of the most beautiful sights of Udaipur.', 14000, 9000, '4', 'Active', 9);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `gst_amount` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('Credit Card','Bank Transfer','UPI','Cash') DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`payment_id`, `booking_id`, `user_id`, `amount`, `gst_amount`, `grand_total`, `payment_method`, `payment_date`) VALUES
(13, 45, 17, 135000.00, 24300.00, 159300.00, 'Credit Card', '2025-04-13 22:11:24'),
(14, 46, 0, 240000.00, 43200.00, 283200.00, 'Bank Transfer', '2025-04-14 10:20:49'),
(15, 47, 17, 51000.00, 9180.00, 60180.00, NULL, '2025-04-14 10:24:36'),
(16, 48, 19, 130000.00, 23400.00, 153400.00, 'Bank Transfer', '2025-04-14 20:06:17'),
(17, 49, 17, 12200.00, 2196.00, 14396.00, 'Credit Card', '2025-04-15 05:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_table`
--

CREATE TABLE `schedule_table` (
  `schedule_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `destination_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_table`
--

INSERT INTO `schedule_table` (`schedule_id`, `package_id`, `day_number`, `title`, `description`, `destination_name`) VALUES
(13, 28, 1, 'Arrival Srinagar', 'Meet & Greet on arrival at Srinagar Airport & transfer to Srinagar Hotel. After fresh up proceed to local sightseeing includes Shankracharya Temple, Nishant Garden, Chashmeshahi Garden, and Shalimar Garden. Evening free for leisure activities. In evening, Enjoy Dinner at Hotel, Overnight\r\nStay in Srinagar.\r\nMeal: Dinner', 'Srinagar'),
(14, 28, 2, 'Srinagar to Kargil ', 'After Breakfast proceed to Kargil via Srinagar Leh Highway. Enjoy a short halt at Sonamarg (Known as gateway to Ladakh & the Meadow of Gold) to admire the views. One can enjoy a pony ride to Thajiwas glacier. Notice the gradual change in the colours of the mountains as you travel to Kargil. Cross the Zojila pass & Drass region. Visit the Zojila War memorial & Kargil War memorial on the way to pay tribute to the Indian Army. It was in this very region in which the Indian Army fought and won the famous war of Kargil. Take some memorable snaps of Tololing, Tiger Hill and the war memorial in Drass. In evening, Enjoy Dinner at Hotel, Overnight stay in Kargil.\r\nMeal: Breakfast & Dinner', 'kargil'),
(15, 28, 3, 'Kargil to Alchi ', ' After an early breakfast, proceed to Alchi / Uleytokpo. En route, visit Mulbek (known for its huge Buddha Statue) and Lamayuru monastery (The oldest monastery in Ladakh). In evening, Enjoy Dinner at Hotel. Overnight stay in Alchi / Uleytokpo. Meal: Breakfast & Dinner', 'kargil'),
(16, 28, 4, 'Alchi / Uleytokpo to Leh', 'After an early breakfast, proceed for a sightseeing tour and visit Alchi Monastery (known for its paintings). Proceed to Leh. Admire the confluence of Indus – Zanskar Rivers and the effects of Magnetic Hill (Defiance of the law of gravity). Visit Gurudwara Patthar Sahib, Kali Mata temple & Hall of Fame (A museum developed and maintained by the Indian army) and reach Leh in the evening. In evening, Enjoy Dinner at Hotel, Overnight stay in Leh.\r\nMeal: Breakfast & Dinner', 'leh'),
(17, 28, 5, 'Leh to Pangong Lake', 'After an early breakfast, visit sightseeing places like Shey, Thiksay, Hemis and Sindhu Ghat and then proceed to Pangong via Changla Pass (17,586 feet) and the third highest pass of the world. Pangong Lake is a salt water body of 120 km in length and 6 – 7 Km broad at the longest point. It is bisected by the international border between India & China (2/3 of the lake is in China’s possession). Visit the exact location of the famous movie “Three idiots” & enjoy outing along the banks of the lake. One really feels very close to nature at Pangong Lake with its scenic surroundings. On a clear sunny day, you can see seven colour formations in the crystal-clear salt water lake. In evening, Enjoy Dinner at Hotel. Overnight stay in Pangong.\r\nMeal: Breakfast & Dinner', 'leh'),
(18, 28, 6, 'Departure from Leh', 'After breakfast, get transferred to Leh Airport for boarding the flight to your destination. Tour Concludes with some wonderful long-lasting memories\r\nMeal: Breakfast', 'leh'),
(19, 29, 1, 'Morning At Splendiferious Saputara', 'The Morning will be welcoming you at Gira Waterfall, an amazing landscape shaded by the cascades spellbinding view, and then we will move towards the campsite. Tent pitching demo and brief instructions about the trek will be given. After having delicious lunch we will trek to Sunset Point. The day will be completed with a dinner and campfire.', 'saputara'),
(20, 29, 2, 'Trek To Governor Hill', 'The day will be start at early morning with a routine warm up exercise and breakfast. We will direct towards Governor Hill for trekking. By completing trek we will come back at our campsite and take Lunch. In evening will do group activities and games. The day will be ended with dinner.', 'saputara'),
(21, 29, 3, 'Sunrise Point and Back to Home', 'Wake up Early morning , Trek to Sunrise Point, Back to Campsite and Breakfast, Free time for Explore Saputara Market, Lunch and we will leave Saputara with a bunch of memories', 'saputara'),
(22, 30, 1, 'Arrival at Jammu- Katra', 'Today morning our representative will assist you at Jammu Railway Station/ Airport & drive you to Katra by Cab. Katra is located at the foothills of Trikuta Mountains; it is frequently visited by\r\ndevotees to seek the blessings of Goddess Vaishno Devi. Katra is nature lovers paradise presenting panoramic views of the surrounding area. On reaching check in to the hotel, after getting refresh you can explore the Katra town. In evening, enjoy Dinner & Overnight stay at hotel.\r\nMeal: Dinner', 'kantra'),
(23, 30, 2, 'Katra- Srinagar ', 'After breakfast check out from hotel & drive towards Srinagar which is your next destination.Transfer you to houseboat. Check in at houseboat, freshen up and relax at the luxury of the royal hospitality. Evening enjoy shikara ride in Dal Lake. A Shikara is a traditional Gondola type light rowing boat which is mostly seen on the pristine Dal Lake. Dinner at Houseboat, Overnight Stay at Srinagar House Boat.\r\nMeal: Breakfast & Dinner', 'Srinagar'),
(24, 30, 3, ' Srinagar - Sonamarg – Srinaga', 'After Breakfast Morning proceed for Gulmarg start for Local Sightseeing Khilanmarg, One can enjoy horse riding / Cable car ride (to be paid directly by the guest). Evening back to Srinagar.\r\nKilanmarg: Khilanmarg, Jammu and Kashmir, India, is a small valley about 6 kilometers away from the Gulmarg. The meadow, carpeted with flowers in the spring, is the site for Gulmarg winter ski runs and offers a view of the surrounding peaks and over the Kashmir Valley. It is a 600 m ascent from Gulmarg to Khilanmarg. Dinner at Hotel, Overnight stay at Srinagar.\r\nMeal: Breakfast & Dinner', 'gulmarg'),
(25, 30, 4, ' Srinagar - Sonamarg – Srinaga', 'After breakfast proceed to Sonamarg. Arrive Sonamarg enjoy a Pony ride on the glacier and enjoy Glacier Zero point by own You have to book taxi from union for Sonamarg local car not allow in thajiwas. Evening back to Srinagar, Dinner at Hotel, Overnight stay at Srinagar.\r\nMeal: Breakfast & Dinner', 'Srinagar'),
(26, 30, 5, 'Srinagar Departure', 'on-time we transfer you to Srinagar airport to board flight for onwards journey or way back home. In this way the tour ends as well as the magic of Kashmir holiday packages offering loads of fun-filled memories to relish in forever and ever.\r\nMeal: Breakfast', 'Srinagar'),
(27, 31, 1, 'Welcome to Goa', 'The first day of your Goa honeymoon holiday welcomes you to the tropical state of Goa. Your journey begins. \r\nUpon your arrival in Goa, an agents representative will receive you at the airport/railway station. Transfer to the hotel and complete check-in formalities. Refresh and take rest for a while. You can spend the first day of your romantic to Goa as per your wish. Spend quality time with your partner or indulge in street shopping. After a laid-back day, come back to the hotel and have a sound sleep.\r\nMeal: Dinner', 'goa'),
(28, 31, 2, 'Sightseeing in North Goa', 'The second day of your honeymoon tour of Goa is reserved for a fun-filled sightseeing tour of North Goa. Post breakfast, get ready for a sightseeing tour of North Goa. Begin with the 17th century Portuguese building Fort Aguada. Next on your romantic Goa trip, visit the Chapora Fort. Enjoy a perfect beach vacation to Goa visiting Calangute Beach, Baga Beach and Anjuna Beach. As the day comes to an end, retire to the hotel and stay for the night.\r\nMeal: Breakfast & Dinner', 'goa'),
(29, 31, 3, 'South Goa sightseeing tour', 'Today, you will explore the eye-catching attractions of South Goa with your Goa honeymoon package.\r\nRelish a nutritious breakfast and head out for exploring the gems of South Goa. Newly-wed couples can seek blessings for their marital life at Shri Shantadurga Temple and Shri Manguesh Temple. Admire the 16th century built Portuguese buildings like Basilica of Bom Jesus and Se Cathedral on the third day of your romantic Goa trip. Post lunch, visit the idyllic Dona Paula Bay to enjoy spectacular views of the Mormugao Harbour with your better half. In the evening, couples can enjoy a river boat cruise ride at the Mandovi River. After an eventful day, come back to the hotel and stay overnight.\r\nMeal: Breakfast & Dinner', 'goa'),
(30, 31, 4, 'Grand Island Tour', 'On the fourth day of your Goa honeymoon holiday, get ready for some serious fun at the Grand Island. Have breakfast and drive to the Coco beach jetty for a mesmerising tour of Grand Island on your honeymoon tour of Goa. Whisper sweet nothings in your partner while enjoying the views of the Millionaire Bungalow and Fort Aguada while sailing on the Arabian Sea. Relish a barbeque lunch with your spouse and later, drive back to the jetty. Transfer to the hotel and have a goodnight’s sleep.\r\nMeal: Breakfast & Dinner', 'goa'),
(31, 31, 5, 'A day at leisure', 'Spend this day of your Goa honeymoon entirely at leisure.\r\nChoose from a fine selection of delectable dishes in the breakfast. You have this day of your honeymoon trip to Goa at your disposal. Stay cosy in the hotel room or experience the nightlife in Goa. As the day bids goodbye, return to the hotel.\r\nMeal: Breakfast & Dinner', 'goa'),
(32, 31, 6, ' Departure', 'Depart from Goa with sweet memories of your honeymoon trip.\r\nAfter breakfast, check-out from the hotel and proceed to airport/railway station to return to home destination.\r\nMeal: Breakfast', 'goa'),
(33, 32, 1, 'Arrival in Goa | Let the fun times begin!', 'Meet and get greeted by our official, who will ensure a smooth transfer to your pre-booked hotel.Complete the check-in formalities and rest for some time.Enjoy the first day of your Goa trip leisurely, go out exploring the surroundings or the beaches nearby while having a great time with your loved ones.Return back to your hotel for an overnight stay in Goa.\r\nMeal: Dinner', 'goa'),
(34, 32, 2, 'Water Sports at Calangute Beach | Experience the adventurous side of Goa', 'Wake up with an amazing breakfast and get ready to have an adventurous day in Goa.Drive to Calangute beach for the various exciting water sports and activities, as this beach offers the best watersports.Indulge yourself in Jet Ski, Paragliding, Bumper rides and splash out on Banana boat rides & Speedboat rides.After adrenaline rush activities, the rest of the day is at your leisure.You can choose to try the delicious local cuisine at the beachside restaurants or spend a relaxing time in the shacks.Watch a beautiful sunset over the Arabian sea, leaving its colors on the azure waters of the sea.Return back to the hotel for an overnight stay in Goa.\r\nMeal: Breakfast & Dinner', 'goa'),
(35, 32, 3, 'Goa | Bid Farewell to the Beaches', 'Wake up in the morning, have a hearty breakfast, pack your bags and complete the check-out formalities.Take along the bundle of joyful memories with you and cherish the moments on arrival at your desired destination.\r\nMeal: Breakfast', 'goa'),
(36, 33, 1, 'Arrival: The beach town of Diu', 'Arrive at the Diu Airport or Railway station and get picked by our professional driver.\r\nCheck-in at the hotel and relax for a while.After a while, head out to explore the region on your own.Explore the beach town, located in the district of Diu, in Daman and Diu Union Territory and check out the fishing activities and water activites of the town.\r\nReturn to the hotel for dinner and overnight comfortable stay. ', 'diu'),
(37, 33, 2, 'Sightseeing in Diu', 'Have a healthy breakfast at the hotel and get ready for an extensive sightseeing tour of Diu.Visit the old churches and historic forts, the prominent highlights of the town.\r\nGo to the Gangeshwar Temple, situated near the seashore.\r\nLater take a boat from Diu jetty to reach the spot to admire the Panikotha Fort resembling the shape of a ship. Also witness a chapel and a lighthouse in the vicinity.\r\nThen proceed to watch the Diu Fort which holds centuries old history and is surrounded by the sea on all the three sides.Reach the hotel for dinner and stay.', 'diu'),
(38, 33, 3, 'Departure', 'Relish in the tasty breakfast before departing.\r\nPack your luggage and check out from the hotel.\r\nEnd your historical Diu tour and get transferred to the airport or railway station, with some amazing memories.', 'diu'),
(39, 34, 1, 'Arrival NJP Railway Station / Bagdogra Airport – Gangtok', 'On arrival at NJP Railway Station / (IXB) Bagdogra Airport, you will be meet by our office\r\nExecutive who will assist you to board your vehicle to Gangtok (130 Kms / 04 to 05 Hrs). Check in and rest of the day at leisure. You can visit the famous M G Marg in this time. In evening, enjoyDinner at Hotel, Overnight stay at Gangtok Hotel.\r\nMeal: Dinner', 'gangtok'),
(40, 34, 2, 'Gangtok – Tshangu Lake & Baba Mandir Excursion', 'After breakfast, in the morning, start for excursion to Tshangu Lake (43 Kms in 02 Hrs one way from Gangtok) Tsangu Lake also known as Tsongmo Lake or Changu Lake, is a glacial lake in the East Sikkim district of the Indian state of Sikkim, the lake remains frozen during the winter season. The lake surface reflects different colors with change of seasons and is held in great reverence by the local Sikkimese people.& Baba Mandir (16 Kms in 01 Hrs one way from Tshangu Lake. Situated at a height of 12400 Ft / 3780 Mts / 43 Kms in 03 Hrs one way, with an average depth of 50 ft. Memorial & Baba temple honoring Indian army soldier, folk hero & saint Baba Harbhajan Singh.Baba Harbhajan Singh Memorial Temple is god of the army, Later Back to Gangtok by evening and Dinner at Hotel, Overnight stay at Gangtok Hotel.\r\n(In case of Landslide or due to any other reasons if Tshangu Lake is closed then an\r\nalternate sightseeing will be provided) Optional Nathula Pass visit (Indo China Border) @ Approx. INR 5500.00 + GST per vehicle.\r\nMeal: Breakfast & Dinner', 'gangtok'),
(41, 34, 3, 'Gangtok – Lachung ', 'After breakfast check out from hotel with limited luggage and proceed to Lachung (8,700 ft.),North Sikkim. On the way take a break for some beautiful spots which are worth seeing and visiting like Naga Waterfall, The Confluence of Lachen Chu (River) &Lachung Chu (River) at Chungthang and BhimNala Waterfall. Visit Tashi view point, seven sisters water fall (Subjected the vehicle take the normal route. These sightseeing points are included on complimentary basis & in case of diversions these points will be missed. There will be no refund in such case).On arrival at Lachung check into your hotel. In evening, enjoy Dinner at Hotel & Overnight stay at Lachung Hotel.\r\nMeal: Breakfast & Dinner', 'lachung'),
(42, 34, 4, 'Lachung - Yumthang Excursion Early morning proceed on a half day excursion to Yumthang Valley', 'Visit to Yumthang Valley is a day excursion from Lachung, which is an attraction for tourist visiting this region. The colorful Singba Rhododendron Sanctuary bloom between April to June. The soaring snow-capped peaks and herds of wandering yaks make this a Himalayan paradise. The valley is also known for its Hot spring. Although the water is quite dirty, many locals from the area visit to get themselves soaked & cured as believed. Dinner at Hotel, Overnight Stay at Lachung Hotel.\r\nMeal: Breakfast & Dinner Optional Yumesamdong (know as Zero Point 15300 Ft / 4665 Mts, 24 Kms / 1.5 to 02 Hrs from Yumthang) visit @ Approx. INR 3500.00 + GST per vehicle.', 'lachung'),
(43, 34, 5, 'Lachung – Gangtok ', 'After breakfast proceed to Gangtok (5,500 ft.). On the way if the weather is clear you may get to see Mighty Khangchendzonga from Singhik view point. On arrival at Gangtok check-in to your hotel. Rest of the evening free for your own activities. Dinner at Hotel, Overnight stay at Gangtok.\r\nMeal: Breakfast & Dinner', 'lachung'),
(44, 34, 6, 'Gangtok – Pelling', 'Morning go for a half day (04 hrs) sightseeing covering Jhakri Water Falls along with DorulChhorten, Research Institute of Tibetology(Closed on Saturday & Sunday, Local Festival and State & National Govt. holidays), Directorate of Handicraft & Handloom (Closed on Saturday & Sunday, Local Festival and State & National Govt. holidays) and Flower Show (Closed on Saturday & Sunday, Local Festival and State & National Govt. holidays). Afternoon transfer to Pelling(116 Kms / 05 to 06 Hrs).Dinner at Hotel, Overnight stay at Pelling Hotel.\r\nMeal: Breakfast & Dinner\r\nNote :\r\nIf the sightseeing points like Research Institute of Tibetology& Directorate of Handicraft &\r\nHandloom are falling on Saturday & Sunday, Local Festival and State & National Govt. holidays then we will include Bakthang Waterfalls, Nam Nang View Point and Enchey Monastery as an alternative sightseeing.', 'gangtok'),
(45, 34, 7, 'Pelling – NJP Rly Station /  Airport ', 'Transfer to NJP Railway Station /  Bagdogra Airport, (150 Kms / 05 to 06 Hrs) for onwards connection.\r\nMeal: Breakfast', 'gangtok'),
(46, 35, 1, 'Arriving at Shimla', 'Meet & Greet On Arrival At Delhi Railway Station / Airport & Transfer To Shimla, Situated At 7000 Feet Above Sea Level, The Heady Combinations Of Chill Mountain Air, Orchards And Colonial Charms Still Make Shimla A Dream Get Away. Arrive & Transfer To Hotel. Rest Of The Day Is Free To Explore Various Scenic Sights Or Visit Mall Road. Dinner At Hotel, Overnight Stay At Shimla Hotel.\r\nMeal: Dinner', 'shimla'),
(47, 35, 2, 'Shimla – Local Sightseeing.', 'After Breakfast, Proceed To Kufri. Kufri Is Famous For Its Himalayan National Park, Poney And Yak Ride (Optional) And One Can See The Endless Himalayan Panorama From Kufri, Later Explore The Various Places In And Around Shimla. Visit The Ridge, Viceregal Lodge, Jakhoo Temple, Christ Church, Scandal Point And Mall Road. The Most Interesting Ones Are The Shimla Mosques Built In 1830 By Viceroy Regal. Dinner At Hotel, Overnight Stay At Shimla Hotel.\r\nMeal: Breakfast & Dinner', 'shimla'),
(48, 35, 3, ' Shimla - Manali', 'After Breakfast, Check Out & Proceed To Manali. On The Way Enjoy River Rafting (Optional) In Beas River It’s A Best Adventure Activity In Himachal. Arrive Manali By The Evening And Check Into The Hotel. Evening Leisure At Your Own. In Evening, Enjoy Dinner At Hotel, Overnight Stay At Manali Hotel.\r\nMeal: Breakfast & Dinner', 'manali'),
(49, 35, 4, 'Manali - Rohtang Road', 'After Breakfast Proceed For Excursion To Rohtang Pass. Situated At An Altitude Of 3979 Mtrs Above Sea Level And 51 Kms Outside Manali Is The Mighty Rohtang Pass - The Gateway To Lahaul-Spiti Valley. It Affords A Wide Panoramic View Of The Mountains. Here One Can See The Majesty Of The Mountains At Its Height And Splendour. At The Top Of The Pass The Air Seems To Glitter Against The Snow As You Look Down Over Herringboned Ridges Into The Lahaul Valley. Evening At Leisure. Dinner At Hotel, Overnight Stay At Manali Hotel.\r\nMeal: Breakfast & Dinner', 'manali'),
(50, 35, 5, 'Manali – Dharmshala', 'After Breakfast Proceed To Dharamshala, On The Way Stopping At Baijnath Known For Its Shiva Temple And Further At Palampur Famous For Tea Garden. Dharamshala Is A Hill-Station Lying On The Spur Of The Dhauladhar Mountains About 18 Kms North-East Of Kangra, It Is Known For Its Scenic Beauty Set Amidst High Pine And Oak Trees. Since 1959, When It Became The Temporary Headquarters & Abode Of His Holiness The Dalai Lama, Dharamshala Has Risen To International Repute As “The Little Lhasa In India”. Later Check Inn To Dharamshala Hotel & In Evening, Enjoy Dinner At Hotel, Overnight Stay At Dharamshala Hotel.\r\nMeal: Breakfast & Dinner', 'dehradun'),
(51, 35, 6, 'Dharmshala - Dalhousie', 'After Breakfast Drive From Dharamshala Towards Dalhousie After Doing The Local Sightseeing Of Places Which Includes, His Holiness Dalai Lama Residence & Tsugalkhang At Mc Leodgunj, St. John’s Church In The Wilderness (Built In 1853),War Memorial, Bhagsunag Temple And Dal Lake, Norbulingka, Guyton Rameda Tantric Monastery. Reach Dalhousie In The Evening. Check Inn To Hotel & Dinner At Hotel, Overnight Stay At Dalhousie Hotel.\r\nMeal: Breakfast & Dinner', 'dharmshala'),
(52, 35, 7, 'Dalhousie - Amritsar ', 'After Breakfast, Check Out From Hotel & Proceed For Amritsar By Road. On Arrival Check-In At Hotel And Later Visit Indo-Pak Wagah Border To Watch Flag Retreat Ceremony- Wagah, An Army Outpost On Indo-Pak Border 30 Kms From Amritsar Where The Daily Highlight Is The Evening “Beating The Retreat” Ceremony. Soldiers From Both Countries March In Perfect Drill, Going Through The Steps Of Bringing Down Their Respective National Flags. As The Sun Goes Down, Nationalistic Fervour Rises And Lights Are Switched On Marking The End Of The Day Amidst Thunderous Applause. Dinner At Hotel, Overnight Stay At Hotel.\r\nMeal: Breakfast & Dinner', 'dalhousie'),
(53, 35, 8, 'Amritsar City Tour – Return Back to Home', 'After Breakfast, Proceed To Visit The Golden Temple And Jalliyanwala Bagh. Later Checkout From Hotel And Proceed To Airport/Railway Station To Board The Flight / Train For Your Home Town.\r\nMeal: Breakfast', 'amritsar'),
(54, 36, 1, ' Arrival ', 'The first day is for your arrival at Gir National Park from Rajkot/Junagarh/Diu. After reaching the gate you will be escorted by our office representative who will further guide you to the wildlife resort. Then as you reach the wildlife resort you will ask to check in as per your selected room the same will be allotted. After checking in and getting refreshed one can have lunch and enjoy the day as leisure. The first day is all on your own to enjoy your private space-time with the forest and get the peace and calmness of the forest. By the end of the day at dinner time there are multiple cuisine options provided for the tourist to select and enjoy.\r\nMeal : Lunch & Dinner', 'gir'),
(55, 36, 2, 'Safari Day', 'After waking up early in the morning the first thing you will be able to witness is the birds singing and chirping around. Buffet breakfast is served in the down-hall of the resort where you can have your breakfast and head toward the safari jeep. Jeep safari starts in the morning as by afternoon there are changes of heat increase and one can easily fall sick so morning time is the best time to explore. While on your safari trail one thing you must know is that this place is the only place where you can find a lion in its natural habitat. The beauties of these species are that they are not only strong and beautiful but the length of the lion is almost 2.75m in length with a long tail and tassel. The jeep safari trail is usually of 3-4 hours max as that is enough to explore the place without disturbing the animals for a long duration of time. During your trail, you will be able to also see the variety of species of birds ad deer which look mesmerising. Once your safari trail is over you will be taken back to your resort for lunch and rest of the day you can spend as you like.\r\nMeal : Breakfast & Lunch', 'gir'),
(56, 36, 3, 'Moving Out', 'Wake up again with the soft musical sound of birds and pack all your belongings. You will be having some time in your hand before checking out which you can utilize to explore the other attractions of Gir National park. You can also purchase memoirs for yourself and your dear ones. After having the breakfast buffet you are supposed to clear all your formalities and dues and check out. Then the officials will tell you to check out and escort you to the gate.\r\nMeal : Breakfast', 'gir'),
(57, 37, 1, 'Assemble at Kolkata', 'Depart Kolkata by bus for Sonakhali .Arrive Sonakhali , walk a distance of 10 minutes for transfer to M.V. Chitrarekha or M.V. Sarbajaya by mechanized boat.Dep. Sonakhali Visit Sudhanyakhali & Sajnekhali Watch Towers. Night stay on board at M.V. Chitrarekha / Sarbajaya.\r\n', 'west bangal'),
(58, 37, 2, 'Depart for Dobanki.', 'Arrive Dokanki, visit Watch Tower.Depart Dobanki.Arrive Sonakhali. Transfer to Jetty. Bus will be kept a little off from the Bus Stand (near Petrol Pump.) Board the bus.\r\nDepart Sonakhali by Bus.Arrive Esplanade, Kolkata . The tour ends.', 'west bangal'),
(59, 38, 1, 'Chennai (Arrival)', 'Arrive at Chennai and meet our representative to get the assisted transfer to the hotel. Go on a sightseeing tour covering Snake Park, Marine Beach and other major tourist attractions in Chennai. Overnight stay at pre-booked hotel in Chennai.\r\nMeal: Dinner', 'chennai'),
(60, 38, 2, 'Chennai - Tirupati', 'Take a road journey to Tirupati in morning. On arriving at Tirupati, transfer to the hotel. Tirupati is the most frequented pilgrimage destinations in the country. It is dedicated to Lord Vekateshwara (Balaji). Overnight stay in Tirupati.\r\nMeal: Breakfast & Dinner', 'tirupati'),
(61, 38, 3, 'Tirupati - Chennai', 'Hit the road to Chennai in the morning. On reaching Chennai, get transferred to the hotel. Enjoy leisure and individual activities in the evening. Overnight stay in Chennai.\r\nMeal: Breakfast & Dinner', 'tirupati'),
(62, 38, 4, 'Departure', 'Get transferred to the airport/railway station in the morning for onward journey.\r\nMeal: Breakfast', 'chennai'),
(63, 39, 1, 'Arrival in Dwarka', 'Arrive at Dwarka and meet our representative to get the assisted transfer to the hotel. Go on a  tour covering gomrighat,lighthouse,bhatkeshwar temple and dwarkadhish darshan in dwarka . Overnight stay at pre-booked hotel in Chennai.\r\nMeal: Dinner', 'Dwarka'),
(64, 39, 2, 'tour of dwarka -end journey', 'Take a road journey to bet dwarka in morning. On arriving at dwarka, transfer to the hotel. shivrajpur beach is the most frequented pilgrimage destinations in the country. \r\nMeal: Breakfast & Dinner', 'Dwarka'),
(65, 40, 1, 'Arrival at Jaipur', 'Arrive At Jaipur Railway Station/Airport And Transfer To The Hotel. On Arrival Check Into Hotel.After Freshen Up Ready To Visit Jal Mahal, Jaigarh Fort , Day At Leisure Or Enjoy Local Market Of Jaipur ( On Your Own ) Evening Proceed For Amber Fort To Enjoy Sound & Light Show. Later Enjoy Dinner at Hotel. Overnight At Jaipur.\r\nMeal: Dinner', 'Jaipur'),
(66, 40, 2, 'Jaipur', 'Today Full Day Sightseeing Tour Of Jaipur City , Covering Hawa Mahal , City Palace , Jantar Mantar Observatory, Laxmi Narayan Temple , Albert Hall Museum, Birla Mandir And Ram Niwas Garden , In The Evening Go On An Extensive Shopping Excursion To The Famous Markets In Jaipur , Jauhari Bapu & Nehru Bazaars. Later Enjoy Dinner At Hotel, Overnight Stay At Jaipur.\r\nMeal: Breakfast & Dinner\r\n', 'Jaipur'),
(67, 40, 3, 'Hotel – Jaipur Airport / Railway Station', 'After Breakfast Check Out From Hotel And Transfer To Jaipur Railway Station / Airport For your onward Journey.\r\nMeal: Breakfast', 'Jaipur'),
(68, 41, 1, 'Arrival at Udaipur', 'On Arrival Pick Up From Airport/Railway Station And Proceed To Hotel, Rest Day Free For Personal Activities.  Udaipur Is A Beautiful City Of Rajasthan, Udaipur; The City Of Lakes Is Well-Known As The Historic Capital Of The Mewar Kingdom. The Place Takes Every Visitor Through The Rajput Era. Later Enjoy Dinner At Hotel, Overnight  Stay At Udaipur.\r\nMeal: Dinner', 'Udaipur'),
(69, 41, 2, 'Udaipur', 'After Breakfast Leave For A Sightseeing Tour Around Udaipur. You Can Begin With A Visit To Saheliyon-Ki-Bari. Post That, You Can Visit Attractions Like Museum Of Folk Art Which Is Famous For Its Wide Collection Of Puppets, Folk Dresses, Dolls, Ornaments, Paintings And Folk Musical Instruments. Later, You Can Visit The City Palace Which Is Known To Be The Biggest Palace Complex In India. In The Evening, Enjoy A Boat Ride At Pichola Lake Which Is The Star Attraction Of Udaipur. Later Enjoy Dinner At Hotel, Overnight  Stay At Udaipur.\r\nMeal: Breakfast & Dinner', 'Udaipur'),
(70, 41, 3, 'Udaipur – Ekling Ji And Nagda Temples', 'After Breakfast, Excursion To Eklingji Temples Its Neighboring Cities Also Have Some Very Beautiful Temples. And The Eklingji And Nagda Temples Are A Must Visit. We Begin Our Tour With Eklingji. The Town Has In All About 70 Temples Including The Famous Eklingji Shiva Temple. The Original Structure Of The Temple Was Built In 734 A.D. The Temple Has A Beautiful Rustic Architecture With Distinctly Carved Tower. The Temple Also Has Beautiful And Heavy Silver Doors. On Entering The Main Hall, You Are Greeted By A Mesmerizing Fragrance And A Silver Image Of Nandi. There Are Two More Nandis In The Temple; One Made Of Black Stone And The Other Of Brass. Shiva Is Worshipped Here In The Form Of A Four Faced Black Marble Image Evening Visit Local Market. Later Enjoy Dinner At Hotel, Overnight Stay At Udaipur.\r\nMeal: Breakfast & Dinner', 'Udaipur'),
(71, 41, 4, 'Udaipur - Station Drop ', 'After Breakfast Check-Out From The Hotel, Drop To Airport.\r\nMeal: Breakfast', 'Udaipur');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(3) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobile` varchar(14) NOT NULL,
  `user_dob` date NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_doj` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_dob`, `user_password`, `user_doj`) VALUES
(17, 'jitt', 'jitt@gmail.com', '749091144', '2002-12-12', '$2y$10$iTo9BMSEAeuADjVMjOeEYu1U.8QXyddr0h1qPZKrE/F03Lie5ETOm', '2025-03-27 16:36:31'),
(18, 'Smit Rana', 'smitrana8923@gmail.com', '9510246043', '2003-09-08', '$2y$10$Uw4kZ7fbLNYpDNliKcZq8Op4HVmL1/0V6aarNGimcbg0gBzinHADa', '2025-04-04 11:17:30'),
(19, 'Dabhi Jitendra', 'dabhijitendra5927@gmail.com', '7490941144', '2001-10-12', '$2y$10$91UDtOcLVB3r0AhPHlRPL.RYLHbdT05wcMWHzcm66jxcGbhSY/g.W', '2025-04-15 01:26:40'),
(20, '_.jit.t._', 'jitt1@gmail.com', '7490941144', '2001-02-14', '$2y$10$V.A2ndKqvfYA0MZVIPj9ROatHA803hF/3XrAjzA8WwQUVvXjC26x6', '2025-04-15 10:25:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_table`
--
ALTER TABLE `contact_table`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `departure_dates`
--
ALTER TABLE `departure_dates`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `destination_table`
--
ALTER TABLE `destination_table`
  ADD PRIMARY KEY (`destination_id`),
  ADD UNIQUE KEY `destination_name` (`destination_name`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `hotel_table`
--
ALTER TABLE `hotel_table`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`pimg_id`);

--
-- Indexes for table `package_table`
--
ALTER TABLE `package_table`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `schedule_table`
--
ALTER TABLE `schedule_table`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking_table`
--
ALTER TABLE `booking_table`
  MODIFY `booking_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_table`
--
ALTER TABLE `contact_table`
  MODIFY `contact_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departure_dates`
--
ALTER TABLE `departure_dates`
  MODIFY `depart_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `destination_table`
--
ALTER TABLE `destination_table`
  MODIFY `destination_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `feedback_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `hotel_table`
--
ALTER TABLE `hotel_table`
  MODIFY `hotel_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `pimg_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `package_table`
--
ALTER TABLE `package_table`
  MODIFY `package_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schedule_table`
--
ALTER TABLE `schedule_table`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_table`
--
ALTER TABLE `booking_table`
  ADD CONSTRAINT `booking_table_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package_table` (`package_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
