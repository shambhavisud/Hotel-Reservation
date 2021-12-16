-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 04:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wda_db`
--
DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ShowBooking` (IN `name` VARCHAR(250))  BEGIN
set @table=name;
set @sql_text=concat('select * from',@table);
prepare stmt from @sql_text;
execute stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `check_in_date` varchar(250) NOT NULL,
  `check_out_date` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --
-- -- Triggers `favorites`
-- --
DELIMITER $$
CREATE TRIGGER `ShowFav` AFTER INSERT ON `favorites` FOR EACH ROW BEGIN
INSERT INTO favorites VALUES(NEW.favorite_id,CURRENT_DATE(),NEW.status,NEW.user_id,NEW.room.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `text` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `reviews`
--
DELIMITER $$
CREATE TRIGGER `REVIEWDISPLAY` AFTER INSERT ON `reviews` FOR EACH ROW BEGIN
INSERT INTO reviews VALUES(NEW.review_id,NEW.rate,NEW.text,CURRENT_DATE(),NEW.user_id,NEW.room.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `area` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `room_type` int(11) NOT NULL,
  `count_of_guests` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `lat_location` varchar(500) NOT NULL,
  `lng_location` varchar(500) NOT NULL,
  `short_description` varchar(250) NOT NULL,
  `long_description` text NOT NULL,
  `parking` int(11) NOT NULL,
  `wifi` int(11) NOT NULL,
  `pet_friendly` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `name`, `city`, `area`, `photo`, `room_type`, `count_of_guests`, `price`, `location`, `lat_location`, `lng_location`, `short_description`, `long_description`, `parking`, `wifi`, `pet_friendly`) VALUES
(1, 'Trident Bandra Kurla', 'Mumbai', 'Bandra', 'room-1.jpg', 1, 1, 3500, 'Bandra Kurla Complex', '19.066564', '72.867622', 'The 5-star Trident Bandra Kurla provides an outdoor swimming pool and full spa services. Concierge services and room service are available 24 hours. On-site parking is free. Complimentary WiFi is available in all rooms.', 'Stylish with accents of red, the air-conditioned rooms are equipped with a flat-screen TV, DVD Player and iPod connections. A well-stocked minibar and a personal safe are also included. En suite bathrooms come with either a shower or a bathtub.\nTrident Bandra Kurla is located in North Mumbai, a 15-minute drive from the domestic airport. It is a 20-minute drive from Chhatrapati Shivaji International Airport and a 40-minute drive from Western Railway Terminus.Botticino restaurant serves fine wine and Italian dishes, while 022 restaurant offers an interactive sushi bar, as well as Western and Asian food. Other dining options include regional Indian food at Maya restaurant and salads at Trident Patisserie & Delicatessen.At Trident Spa & Fitness Centre, guests can look forward to relaxing massage treatments or a good workout at the gym. The hotel also provides a business centre and a souvenir shop.\nCouples particularly like the location — they rated it 9.0 for a two-person trip.We speak your language!\r\n', 1, 1, 0),
(2, 'The Taj Mahal Tower', 'Mumbai', 'South Mumbai', 'room-2.jpg', 2, 2, 5000, 'Colaba', '18.9220', '72.8334', 'Built in 1973, the iconic The Taj Mahal Tower Mumbai stands majestically across from the Gateway of India, overlooking the Arabian Sea.', 'Guests are spoiled for choice in dining options – the famous Wasabi by Morimoto offers innovative Japanese cuisine, and other gourmet highlights include the Golden Dragon Chinese Restaurant and the poolside Aquarius Lounge.Stylishly designed, the rooms offer amazing sea, city or pool views. Each room includes a 32-inch flat-screen TV, a well-stocked minibar, free WiFi and a luxurious bathroom.\nYou can pamper yourself with an indulgent treatment at the Taj Salon, take a dip in the landscaped pool or treat yourself to some luxury shopping at Dior, Louis Vuitton or Stephano Ricci. Yacht service is available at an additional charge.The Taj Mahal Tower is in the popular Colaba area and is just a 10-minute walk from the National Gallery of Modern Art. Mumbai International Airport is 25.7 km away.\nCouples particularly like the location — they rated it 9.6 for a two-person trip.We speak your language!\r\n', 1, 1, 0),
(3, 'Grand Hyatt', 'Mumbai', 'Santacruz', 'room-3.jpg', 3, 3, 4200, 'Off Western Express Highway', '19.076967', '72.851395', 'The hotel’s multidimensional lifestyle complex is home to award winning dining experiences, well-appointed wellness and recreation facilities and aesthetic rooms and apartments.', 'Rooms at Grand Hyatt feature modern décor and floor-to-ceiling windows with courtyard or city views. Some rooms have a balcony. The en-suite bathrooms have a separate bath and come with free toiletries.Free private parking is available upon reservation and an airport shuttle service is provided. Chhatrapati Shivaji International Airport is only 10 km away, while Bandra Kurla Complex is an 8-minute drive away.\nThere is 4 award-winning signature restaurants offering a variety of cuisines at Mumbai Grand Hyatt, and guests can enjoy a cocktail in the lobby bar. Local and international produce can also be purchased at the gourmet store.\r\n', 1, 1, 1),
(4, 'The Oberoi', 'Mumbai', 'South Mumbai', 'room-4.jpg', 2, 2, 2500, 'Nariman Point', '18.9375', '72.8255', 'Centrally located in Mumbai business district, close to South Mumbai shopping and entertainment areas, The Oberoi offers luxury and convenience.', 'The Oberoi, Mumbai offers luxury and convenience with a wide range of 24 hour services like spa, butler service, laundry, concierge, business centre and travel desk. There are female butlers for the comfort of female guests travelling alone. Guests can enjoy shopping at the luxury retail arcade. The Oberoi Spa offers a variety of treatments and therapies.\nEuropean, Asian and Indian specialities are featured on the menu at Fenix, alongside traditional Japanese delicacies. Vetro serves Italian dishes, while Indian cuisine can be savoured at Ziya. The Eau Bar overlooks the Arabian sea and features a live Jazz band. The Champagne Lounge serves an extensive selection of Champagne and teas.\nSituated at Nariman Point at the end of Marine Drive, The Oberoi Mumbai is 24 km from Mumbai Chhatrapati Shivaji International Airport. Mumbai Central Railway Station is 6 km away.\r\n', 0, 1, 0),
(5, 'ITC Grand Chola', 'Chennai', 'Guindy', 'room-5.jpg', 2, 2, 4000, '63, Mount Road', '13.0103', '80.2205', 'Situated along Mount Road in Chennai, ITC Grand Chola is 8 km from the Chennai International Airport.', 'International delights are served at Madras Pavilion and Cafe Mercara Express. Ottimo Cucina Italiana offers Italian specialities, while Royal Vega features vegetarian dishes. Avartana offers contemporary Southern Indian cuisine.Nutmeg The Gourmet Shop serves sandwiches, pastries, chocolates and milkshakes. The Cheroot serves malt and snacks can be enjoyed at the Cigar Lounge. Peshawari serves a selection of tandoori and Oriental delights can be relished at the Pan Asian. Refreshing beverages are served at Tranquebar.\nThe contemporary air-conditioned rooms feature a flat-screen TV with satellite channels, an electric kettle and a wardrobe. The en suite bathroom comes with shower facilities. Room service is provided.\r\n', 1, 1, 1),
(6, 'Citadines OMR', 'Chennai', 'Sholinganallur', 'room-6.jpg', 3, 3, 3200, 'IT Expressway', '12.9005', '80.2273', 'Situated in Chennai, Citadines OMR Chennai features a fitness centre and a garden. Popular points of interest around the property include Indian Institute of Technology, Madras and Anna University.', 'All rooms features a flat-screen TV with cable channels, a kettle, a bath, free toiletries and a desk. Rooms are complete with a private bathroom fitted with a hairdryer, while some rooms also offer a balcony. All guest rooms feature a seating area.\nA continental breakfast is served every morning at Hola, the restaurant. Delhi Highway Restaurant features flavors of Punjab, Veggie Friendly, Authentic North Indian and Jain Food Collections\nThe wellness area at the hotel is comprised of a hot tub and a sauna.\nWith staff speaking Hindi and English, nonstop information is available at the reception.\r\n', 0, 1, 0),
(7, 'Radisson', 'Noida', 'Sector 55', 'room-7.jpg', 2, 2, 1700, 'Block C', '28.6042', '77.3502', 'Featuring a 24-hour front desk and free WiFi throughout the property, Radisson Noida also boasts an outdoor rooftop swimming pool and 3 dining options on property.', 'Explore global cuisine at The Creative Kitchen, or sample an expansive kabab selection at The Great Kabab Factory. Ni-Hao serves southeast Asian delicacies. Guests can unwind with a pastry from Cakewalk and enjoy a relaxed evening at Ethyl Bar.\nThe hotel also houses a fitness centre, meeting and banquet hall and a business centre. Guests can also make travel arrangements via the tour desk.\nEach air-conditioned room features a flat-screen TV with satellite channels and a seating area. The attached bathroom has free bath amenities.\r\n', 1, 1, 1),
(8, 'Treebo Trip City Centre', 'Noida', 'Sector 36', 'room-8.jpg', 4, 4, 2800, 'Block B', '28.5740', '77.3515', 'Featuring 3-star accommodation, Treebo Trip City Centre Noida is located in Noida, 3.3 km from Worlds of Wonder and 3.3 km from The Great India Place.', 'At the hotel, every room comes with a desk, a flat-screen TV and a private bathroom. All units at Treebo Trip City Centre Noida include air conditioning and a wardrobe.\nA continental breakfast is available daily at the accommodation.\nThe nearest airport is Delhi International Airport, 34 km from Treebo Trip City Centre Noida.\nWe speak your language!\r\n', 1, 1, 0),
(9, 'ITC Royal Bengal', 'Kolkata', 'Haldane Avenue', 'room-9.jpg', 2, 2, 3000, 'JBS', '22.5461', '88.3973', 'Situated in Kolkata, 7 km from Indian Museum, ITC Royal Bengal, a Luxury Collection Hotel, Kolkata features accommodation with a restaurant, free private parking, a fitness centre and a bar. ', 'At the hotel, the rooms include a desk and a flat-screen TV. All rooms have a wardrobe.\nA buffet breakfast is available each morning at ITC Royal Bengal, a Luxury Collection Hotel, Kolkata.\nThe accommodation offers 5-star accommodation with a sauna and outdoor pool.\nNandan is 7 km from ITC Royal Bengal, a Luxury Collection Hotel, Kolkata, while New Market is 7 km from the property. The nearest airport is Netaji Subhash Chandra Bose International Airport, 12 km from the hotel.\nCouples particularly like the location — they rated it 9.1 for a two-person trip.\r\n', 0, 1, 0),
(10, 'Hyatt Regency', 'Kolkata', 'Salt Lake City', 'room-10.jpg', 3, 3, 4100, 'Sector III ', '22.5707', '88.4052', 'Located in Kolkata business district of Salt Lake City, 1 km away from Apollo Hospital, Hyatt Regency features modern rooms, an outdoor swimming pool and 6 food and beverage options.', 'Decorated with a calming colour palette, air-conditioned rooms are equipped with a flat-screen TV with satellite channels, a minibar and desk. The en suite bathroom comes with a rain shower and a bathtub. Free toiletries and a hairdyer are provided for added convenience.\nTour and day trip information can be obtained at the travel desk. Other facilities includes a 24-hour front desk, business centre and shops. Wi-Fi is available at an extra charge.\nGuchhi serves signature North Indian dishes, while Italian cuisine can be savoured at La Cucina. The Hyatt also has a bakery and an all-day dining restaurant. Alcoholic and non-alcoholic beverages can be enjoyed at the bar or by the pool. Room service is available.\r\n', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `room_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `room_type`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Triple Room'),
(4, 'Fourfold Room');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`) VALUES
(1, 'username_default1', 'email_user1@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
