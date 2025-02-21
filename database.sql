CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB 
  AUTO_INCREMENT=3 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `name`, `title`) VALUES
	(1, 'smartphones', 'Mobiele telefoons'),
	(2, 'tablets', 'Tablets');

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ipAddress` varchar(45) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT 'UTC',
  `emailVerified` tinyint(1) DEFAULT '0',
  `verificationCode` mediumint DEFAULT NULL,
  `verificationExpiresAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `lastUpdatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `emailQueue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `deviceId` int DEFAULT NULL,
  `email` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `subject` longtext COLLATE utf8mb4_general_ci,
  `htmlBody` longtext COLLATE utf8mb4_general_ci,
  `altBody` longtext COLLATE utf8mb4_general_ci,
  `sent` int DEFAULT '0',
  `errorMessage` text COLLATE utf8mb4_general_ci,
  `addedTime` timestamp NULL DEFAULT NULL,
  `procesTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  AUTO_INCREMENT=7 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `emailQueue` (`id`, `userId`, `deviceId`, `email`, `subject`, `htmlBody`, `altBody`, `sent`, `errorMessage`, `addedTime`, `procesTime`) VALUES
	(1, 1, 1, 'tomtiedemann30@gmail.com', '2-staps verificatie code', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - E-mail verificatie</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .verification-code {\n            display: block;\n            font-size: 28px;\n            font-weight: bold;\n            margin: 20px 0;\n            text-align: center;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Bedankt voor het aanmaken van een account bij <strong>SimpelWinkelen</strong>! We zijn blij dat je er\n                bent.\n                Om je account te activeren en toegang te krijgen tot alle functies, vragen we je om je e-mailadres te\n                bevestigen.</p>\n\n            <p>Gebruik onderstaande code om je account te verifiëren:</p>\n            <span class="verification-code">942898</span>\n\n            <p>Mocht je deze e-mail niet hebben aangevraagd of denk je dat er iets niet klopt, neem dan gerust contact met ons op via <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.</p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nBedankt voor het aanmaken van een account bij SimpelWinkelen!\nOm je account te verifiëren, gebruik je de volgende code:\n\n942898\n\nAls je deze e-mail niet zelf hebt aangevraagd of als je vragen hebt, \nneem dan contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-16 12:07:51', NULL),
	(2, 1, 1, 'tomtiedemann30@gmail.com', '2-staps verificatie code', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - E-mail verificatie</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .verification-code {\n            display: block;\n            font-size: 28px;\n            font-weight: bold;\n            margin: 20px 0;\n            text-align: center;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Bedankt voor het aanmaken van een account bij <strong>SimpelWinkelen</strong>! We zijn blij dat je er\n                bent.\n                Om je account te activeren en toegang te krijgen tot alle functies, vragen we je om je e-mailadres te\n                bevestigen.</p>\n\n            <p>Gebruik onderstaande code om je account te verifiëren:</p>\n            <span class="verification-code">942898</span>\n\n            <p>Mocht je deze e-mail niet hebben aangevraagd of denk je dat er iets niet klopt, neem dan gerust contact met ons op via <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.</p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nBedankt voor het aanmaken van een account bij SimpelWinkelen!\nOm je account te verifiëren, gebruik je de volgende code:\n\n942898\n\nAls je deze e-mail niet zelf hebt aangevraagd of als je vragen hebt, \nneem dan contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-16 12:08:57', NULL),
	(3, 1, 1, 'tomtiedemann30@gmail.com', '2-staps verificatie code', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - E-mail verificatie</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .verification-code {\n            display: block;\n            font-size: 28px;\n            font-weight: bold;\n            margin: 20px 0;\n            text-align: center;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Bedankt voor het aanmaken van een account bij <strong>SimpelWinkelen</strong>! We zijn blij dat je er\n                bent.\n                Om je account te activeren en toegang te krijgen tot alle functies, vragen we je om je e-mailadres te\n                bevestigen.</p>\n\n            <p>Gebruik onderstaande code om je account te verifiëren:</p>\n            <span class="verification-code">386310</span>\n\n            <p>Mocht je deze e-mail niet hebben aangevraagd of denk je dat er iets niet klopt, neem dan gerust contact met ons op via <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.</p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nBedankt voor het aanmaken van een account bij SimpelWinkelen!\nOm je account te verifiëren, gebruik je de volgende code:\n\n386310\n\nAls je deze e-mail niet zelf hebt aangevraagd of als je vragen hebt, \nneem dan contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-16 12:23:34', NULL),
	(4, 1, 1, 'tomtiedemann30@gmail.com', '2-staps verificatie code', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - E-mail verificatie</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .verification-code {\n            display: block;\n            font-size: 28px;\n            font-weight: bold;\n            margin: 20px 0;\n            text-align: center;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Bedankt voor het aanmaken van een account bij <strong>SimpelWinkelen</strong>! We zijn blij dat je er\n                bent.\n                Om je account te activeren en toegang te krijgen tot alle functies, vragen we je om je e-mailadres te\n                bevestigen.</p>\n\n            <p>Gebruik onderstaande code om je account te verifiëren:</p>\n            <span class="verification-code">386310</span>\n\n            <p>Mocht je deze e-mail niet hebben aangevraagd of denk je dat er iets niet klopt, neem dan gerust contact met ons op via <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.</p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nBedankt voor het aanmaken van een account bij SimpelWinkelen!\nOm je account te verifiëren, gebruik je de volgende code:\n\n386310\n\nAls je deze e-mail niet zelf hebt aangevraagd of als je vragen hebt, \nneem dan contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-16 12:23:48', NULL),
	(5, 1, 1, 'tomtiedemann30@gmail.com', 'Bevestiging van nieuwe login', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - Nieuwe login gedetecteerd</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .login-info {\n            background-color: #f0f4fc;\n            border: 1px solid #c7c7c7;\n            border-radius: 5px;\n            padding: 15px;\n            margin: 20px 0;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Er is zojuist een nieuwe login op jouw account gedetecteerd bij <strong>SimpelWinkelen</strong>.\n                Mocht dit door jou zijn uitgevoerd, dan kun je deze melding als niet-verstorend beschouwen.\n                Als je hier echter geen actie in hebt ondernomen, neem dan zo snel mogelijk contact met ons op.</p>\n\n            <div class="login-info">\n                <p><strong>Datum en tijd:</strong> 2025-02-16 14:24:05</p>\n                <p><strong>IP-adres:</strong> 193.187.130.121</p>\n                <p><strong>Gebruikt apparaat:</strong> Desktop</p>\n            </div>\n\n            <p>Mocht je deze login niet herkennen, aarzel dan niet om contact op te nemen met onze klantenservice via\n                <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.\n            </p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nEr is zojuist een nieuwe login op jouw account gedetecteerd bij SimpelWinkelen.\n\nDetails van de login:\n- Datum en tijd: 2025-02-16 14:24:05\n- IP-adres: 193.187.130.121\n- Gebruikt apparaat: Desktop\n\nHerken je deze login? Dan kun je deze melding als bevestiging zien dat het account veilig is.\nMocht je deze login niet herkennen, neem dan direct contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-16 12:24:05', NULL),
	(6, 1, 2, 'tomtiedemann30@gmail.com', '2-staps verificatie code', '<!DOCTYPE html>\n<html lang="nl">\n\n<head>\n    <meta charset="UTF-8">\n    <title>SimpelWinkelen - E-mail verificatie</title>\n    <style>\n        body {\n            margin: 0;\n            padding: 0;\n            font-family: Arial, Helvetica, sans-serif;\n            background-color: #f4f4f4;\n            color: #333;\n        }\n\n        .email-container {\n            max-width: 600px;\n            margin: 40px auto;\n            background-color: #ffffff;\n            border-radius: 5px;\n            overflow: hidden;\n            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);\n        }\n\n        .email-header {\n            background-color: #0000a3;\n            color: #ffffff;\n            padding: 20px;\n            text-align: center;\n        }\n\n        .email-header h1 {\n            font-size: 24px;\n            margin: 0;\n            font-weight: 900;\n        }\n\n        .email-body {\n            padding: 20px;\n        }\n\n        .email-body p {\n            font-size: 16px;\n            line-height: 1.5;\n            margin-bottom: 16px;\n        }\n\n        .verification-code {\n            display: block;\n            font-size: 28px;\n            font-weight: bold;\n            margin: 20px 0;\n            text-align: center;\n        }\n\n        .email-footer {\n            background-color: #f1f1f1;\n            text-align: center;\n            padding: 10px;\n            font-size: 14px;\n            color: #555;\n        }\n    </style>\n</head>\n\n<body>\n    <div class="email-container">\n        <div class="email-header">\n            <h1>SimpelWinkelen</h1>\n        </div>\n\n        <div class="email-body">\n            <p>Beste gebruiker,</p>\n            <p>Bedankt voor het aanmaken van een account bij <strong>SimpelWinkelen</strong>! We zijn blij dat je er\n                bent.\n                Om je account te activeren en toegang te krijgen tot alle functies, vragen we je om je e-mailadres te\n                bevestigen.</p>\n\n            <p>Gebruik onderstaande code om je account te verifiëren:</p>\n            <span class="verification-code">504312</span>\n\n            <p>Mocht je deze e-mail niet hebben aangevraagd of denk je dat er iets niet klopt, neem dan gerust contact met ons op via <a href="mailto:support@simpelwinkelen.nl">support@simpelwinkelen.nl</a>.</p>\n\n            <p>Met vriendelijke groet,<br>\n                Het team van SimpelWinkelen</p>\n        </div>\n\n        <div class="email-footer">\n            &copy; 2025 SimpelWinkelen\n        </div>\n    </div>\n</body>\n\n</html>', 'Beste gebruiker,\n\nBedankt voor het aanmaken van een account bij SimpelWinkelen!\nOm je account te verifiëren, gebruik je de volgende code:\n\n504312\n\nAls je deze e-mail niet zelf hebt aangevraagd of als je vragen hebt, \nneem dan contact op met onze klantenservice via support@simpelwinkelen.nl.\n\nMet vriendelijke groet,\nHet team van SimpelWinkelen\n', 0, NULL, '2025-02-19 20:44:05', NULL);

CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `mainImage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `galleryImages` text COLLATE utf8mb4_general_ci,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_products_category` (`category`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category`) REFERENCES `categories` (`name`)
) ENGINE=InnoDB 
  AUTO_INCREMENT=21 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`id`, `category`, `brand`, `name`, `title`, `price`, `description`, `mainImage`, `galleryImages`, `createdAt`, `updatedAt`) VALUES
	(1, 'smartphones', 'apple', 'iphone-16-pro', 'iPhone 16 Pro', 1200.00, 'Ervaar de nieuwste technologie met de iPhone 16 Pro. Geniet van een verbluffende camera, krachtige prestaties en een elegant design.', 'main.png', NULL, '2025-02-17 09:22:10', '2025-02-20 16:41:32'),
	(2, 'smartphones', 'samsung', 'galaxy-s25-ultra', 'Galaxy S25 Ultra', 1500.00, "Maak adembenemende foto\'s met de geavanceerde camera en geniet van ultrasnelle prestaties met de Galaxy S25 Ultra.", 'main.png', NULL, '2025-02-19 08:09:35', '2025-02-20 16:41:37'),
	(3, 'smartphones', 'samsung', 'galaxy-s25', 'Galaxy S25', 900.00, 'De Samsung Galaxy S25 biedt krachtige prestaties en een strak design voor een premium smartphone-ervaring.', 'main.png', NULL, '2025-02-19 10:14:38', '2025-02-20 16:41:43'),
	(4, 'smartphones', 'samsung', 'galaxy-s25-plus', 'Galaxy S25 Plus', 1200.00, 'Met de Galaxy S25 Plus heb je alles wat je nodig hebt: snelheid, stijl en een indrukwekkende batterijduur.', 'main.png', NULL, '2025-02-19 10:16:31', '2025-02-20 16:41:49'),
	(5, 'smartphones', 'apple', 'iphone-16', 'iPhone 16', 1000.00, 'Ontdek de iPhone 16: een perfecte mix van prestaties, stijl en innovatie. Jouw ideale dagelijkse metgezel.', 'main.png', NULL, '2025-02-19 10:17:36', '2025-02-20 16:52:52'),
	(6, 'smartphones', 'oneplus', 'oneplus-13', '13', 1200.00, 'Snel, krachtig en stijlvol: de OnePlus 13 biedt topklasse prestaties en een vloeiende gebruikerservaring.', 'main.png', NULL, '2025-02-19 10:19:24', '2025-02-20 16:42:02'),
	(7, 'smartphones', 'samsung', 'galaxy-a55-5g', 'Galaxy A55 5G', 500.00, 'Supersnel 5G, een prachtige display en een batterij die de hele dag meegaat – de Galaxy A55 5G heeft het allemaal!', 'main.png', NULL, '2025-02-19 10:23:17', '2025-02-20 16:42:08'),
	(8, 'tablets', 'samsung', 'galaxy-tab-a9-plus', 'Galaxy Tab A9 Plus', 250.00, 'Perfect voor werk en entertainment! De Galaxy Tab A9 Plus biedt een groot scherm en lange batterijduur voor eindeloos plezier.', 'main1.png', NULL, '2025-02-19 10:26:05', '2025-02-20 16:42:13'),
	(9, 'smartphones', 'apple', 'iphone-15', 'iPhone 15', 900.00, 'De iPhone 15 brengt een krachtig design en indrukwekkende prestaties samen in een stijlvolle behuizing.', 'main.png', NULL, '2025-02-20 16:52:42', '2025-02-20 17:24:35'),
	(10, 'smartphones', 'samsung', 'galaxy-a16', 'Galaxy A16', 200.00, 'Betaalbaar en betrouwbaar: de Samsung Galaxy A16 biedt een lange batterijduur en een helder scherm.', 'main.png', NULL, '2025-02-20 16:54:07', '2025-02-20 17:24:35'),
	(11, 'smartphones', 'samsung', 'galaxy-s24-ultra', 'Galaxy S24 Ultra', 1500.00, "De ultieme flagship-ervaring! Maak haarscherpe foto\'s en werk razendsnel met de Galaxy S24 Ultra.", 'main.png', NULL, '2025-02-20 16:56:09', '2025-02-20 17:24:35'),
	(12, 'smartphones', 'apple', 'iphone-14', 'iPhone 14', 750.00, 'Een tijdloos design met krachtige hardware: de iPhone 14 blijft een topkeuze.', 'main.png', NULL, '2025-02-20 16:56:48', '2025-02-20 17:24:35'),
	(13, 'smartphones', 'oneplus', 'oneplus-13r', '13R', 750.00, 'Snel, stijlvol en krachtig – de OnePlus 13R levert topprestaties tegen een scherpe prijs.', 'main.png', NULL, '2025-02-20 16:58:06', '2025-02-20 17:24:35'),
	(14, 'smartphones', 'samsung', 'galaxy-s24', 'Galaxy S24', 960.00, 'Met de Galaxy S24 geniet je van premium features, een haarscherp scherm en razendsnelle prestaties.', 'main.png', NULL, '2025-02-20 16:59:02', '2025-02-20 17:24:35'),
	(15, 'smartphones', 'motorola', 'razr-50', 'Razr 50', 900.00, 'Ervaar de nostalgie in een modern jasje! De Motorola Razr 50 is een vouwbare telefoon met high-end specificaties.', 'main.png', NULL, '2025-02-20 17:01:22', '2025-02-20 17:24:35'),
	(16, 'smartphones', 'xaomi', 'redmi-14c', 'Redmi 14C', 180.00, 'Krachtige prestaties en razendsnel 5G-internet in een betaalbare smartphone.', 'main1.png', NULL, '2025-02-20 17:07:39', '2025-02-20 17:24:35'),
	(17, 'smartphones', 'motorola', 'moto-g85-5g', 'Moto G85 5G', 350.00, 'Met de Oppo A80 5G krijg je snelheid, een groot scherm en een krachtige batterij voor een betaalbare prijs.', 'main.png', NULL, '2025-02-20 17:09:40', '2025-02-20 17:24:35'),
	(18, 'smartphones', 'oppo', 'a80-5g', 'A80 5G', 300.00, 'Een minimalistisch design met maximale prestaties – de Nothing Phone (2a) laat zich zien!', 'main.png', NULL, '2025-02-20 17:10:47', '2025-02-20 17:24:36'),
	(19, 'smartphones', 'nothing', 'Phone-2a', 'Phone (2a)', 380.00, 'Een budgetvriendelijke krachtpatser met een groot scherm en betrouwbare prestaties.', 'main.png', NULL, '2025-02-20 17:12:03', '2025-02-20 17:24:36'),
	(20, 'smartphones', 'xaomi', 'redmi-a3', 'Redmi A3', 120.00, 'Compact, licht en perfect voor de basis: de Xiaomi Redmi A3 biedt een solide ervaring voor weinig geld.', 'main.png', NULL, '2025-02-20 17:13:11', '2025-02-20 17:24:36');

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  AUTO_INCREMENT=2 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `email`, `password`) VALUES
	(1, 'tomtiedemann30@gmail.com', '$2y$10$OEbHoZBkLXzlHPB88BDVze7M.O.cTD.LgJ.Wrkp9NNP6zQM/dl7xi');