-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-08-24 10:34:16
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `figure`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `thumbnail` varchar(255) NOT NULL COMMENT 'サムネイル',
  `link` varchar(255) NOT NULL COMMENT '商品URL',
  `maker` varchar(255) NOT NULL COMMENT 'メーカー',
  `brand` varchar(255) NOT NULL COMMENT 'ブランド',
  `item` varchar(255) NOT NULL COMMENT '商品名',
  `series` varchar(255) DEFAULT NULL COMMENT '作品名',
  `releaseMonth` varchar(255) NOT NULL COMMENT '発売月',
  `releaseDate` varchar(255) DEFAULT NULL COMMENT '発売日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `calendar`
--

INSERT INTO `calendar` (`id`, `thumbnail`, `link`, `maker`, `brand`, `item`, `series`, `releaseMonth`, `releaseDate`) VALUES
(1, 'ThFl0KJA33DqlhUgOwM306dWL4yQ6SvR47vz6EMq.jpg', 'http://www.medicomtoy.co.jp/prod/dt/27/1/17183.html', 'MEDICOM TOY', 'MAFEX', 'NIGHTWING', 'BATMAN: HUSH', '2022/11', '1'),
(3, 'XyN2RYDbv3NlzbsLcbDLVc4Y445ApLcsxg6tdVYk.jpg', 'https://www.goodsmile.info/ja/product/13056/figma+%e6%b0%b7%e7%82%8e%e5%b0%86%e8%bb%8d%e3%83%95%e3%83%ac%e3%82%a4%e3%82%b6%e3%83%bc%e3%83%89.html', 'MAX FACTORY', 'figma', '氷炎将軍フレイザード', 'ドラゴンクエスト ダイの大冒険', '2023/07', '1'),
(4, 'FbCG4SeRElviRTduF0cG8yzHIyssvFYpWnrfyAnZ.jpg', 'https://www.toei-anim.co.jp/tv/wt/news/2021121801.php', '東映アニメーション', 'アクションフィギュア', '空閑遊真（玉狛第２.Ver）', 'ワールドトリガー', '2022/09', NULL),
(5, 'EnlI0AE5JjCyU0lRYH6mGCLuVan5JbtfhYBvt2fl.jpg', 'https://tamashii.jp/item/13997/', 'BANDAI', 'NXEDGE STYLE', 'ベルゼブモン：ブラストモード', 'デジタルモンスターシリーズ', '2022/09', '1'),
(6, 'b0yvo051D7aFHhBTzgvt2YDKGigM3W9Ftswsb9a6.jpg', 'https://tamashii.jp/item/13996/', 'BANDAI', 'NXEDGE STYLE', 'デュークモン：クリムゾンモード', 'デジタルモンスターシリーズ', '2022/09', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) DEFAULT NULL COMMENT '氏名',
  `user_name` varchar(255) DEFAULT NULL COMMENT 'ユーザ名',
  `email` varchar(255) NOT NULL COMMENT 'アドレス',
  `body` varchar(255) NOT NULL COMMENT '内容',
  `created_at` datetime NOT NULL COMMENT '送信日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `contact`
--

INSERT INTO `contact` (`id`, `name`, `user_name`, `email`, `body`, `created_at`, `updated_at`) VALUES
(1, 'テスト', NULL, 'test@test.com', 'テスト中', '2022-08-17 02:48:24', '2022-08-17 00:00:00'),
(3, 'テスト3', 'テスト3', 'test@test.com', 'テスト', '2022-08-17 03:26:03', '2022-08-17 00:00:00'),
(4, 'test', NULL, 'test@test.com', 'テストです', '2022-08-22 15:00:59', '2022-08-22 15:00:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite_calendar`
--

CREATE TABLE `favorite_calendar` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `calendar_id` int(11) NOT NULL COMMENT 'カレンダーID',
  `created_at` date DEFAULT NULL COMMENT '登録日時',
  `updated_at` date DEFAULT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `favorite_calendar`
--

INSERT INTO `favorite_calendar` (`id`, `user_id`, `calendar_id`, `created_at`, `updated_at`) VALUES
(11, 5, 3, '2022-08-19', '2022-08-19'),
(16, 5, 4, '2022-08-19', '2022-08-19'),
(24, 5, 5, '2022-08-22', '2022-08-22'),
(25, 4, 1, '2022-08-22', '2022-08-22');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite_posts`
--

CREATE TABLE `favorite_posts` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザーID',
  `posts_id` int(11) NOT NULL COMMENT '記事ID',
  `created_at` date NOT NULL COMMENT '登録日時',
  `updated_at` date NOT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `favorite_posts`
--

INSERT INTO `favorite_posts` (`id`, `user_id`, `posts_id`, `created_at`, `updated_at`) VALUES
(33, 5, 4, '2022-08-18', '2022-08-18'),
(56, 5, 1, '2022-08-18', '2022-08-18'),
(234, 4, 1, '2022-08-19', '2022-08-19'),
(235, 4, 3, '2022-08-22', '2022-08-22'),
(239, 4, 14, '2022-08-22', '2022-08-22'),
(240, 4, 8, '2022-08-22', '2022-08-22'),
(243, 4, 12, '2022-08-23', '2022-08-23'),
(244, 5, 12, '2022-08-23', '2022-08-23'),
(246, 5, 20, '2022-08-23', '2022-08-23');

-- --------------------------------------------------------

--
-- テーブルの構造 `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `body` varchar(255) NOT NULL COMMENT '内容',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '公開:0 非公開:1',
  `created_at` date DEFAULT NULL COMMENT '登録日時',
  `updated_at` date DEFAULT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `info`
--

INSERT INTO `info` (`id`, `title`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ご利用方法', 'フィギュア写真の投稿・閲覧が出来るサービスです。\r\nユーザー登録をするとフィギュア写真の投稿と写真のお気に入り機能、発売日情報のお気に入りが利用出来ます。', 0, '2022-08-16', '2022-08-23'),
(3, 'テスト(非公開)', '非公開機能のテスト', 1, '2022-08-16', '2022-08-22');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'ユーザID',
  `comment` varchar(255) DEFAULT NULL COMMENT 'コメント',
  `thumbnail` varchar(255) NOT NULL COMMENT 'サムネイル',
  `tag1` varchar(255) DEFAULT NULL COMMENT 'タグ1',
  `tag2` varchar(255) DEFAULT NULL COMMENT 'タグ2',
  `tag3` varchar(255) DEFAULT NULL COMMENT 'タグ3',
  `tag4` int(255) DEFAULT NULL COMMENT 'タグ4',
  `tag5` varchar(255) DEFAULT NULL COMMENT 'タグ5',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '公開:0 非公開:1',
  `image1` varchar(255) DEFAULT NULL COMMENT '画像1',
  `image2` varchar(255) DEFAULT NULL COMMENT '画像2',
  `image3` varchar(255) DEFAULT NULL COMMENT '画像3',
  `created_at` datetime DEFAULT NULL COMMENT '投稿日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `comment`, `thumbnail`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `status`, `image1`, `image2`, `image3`, `created_at`, `updated_at`) VALUES
(5, 1, 'トップ画面用①', '4EmtxdxTspTZ18IUMAIiG1EutbtisIwSw4IiCWtk.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-17 00:00:00', '2022-08-17 00:00:00'),
(6, 1, 'トップ画面用②', 'E6DeChSIZivgyAlKuPke44Pu1srhGCJr6hN4sOVy.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-17 00:00:00', '2022-08-17 00:00:00'),
(7, 1, 'トップ画面用③', 'kvgZzfy15rx04AXRTdpH6BXw5F69vBBqC6fOk0Qs.jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-17 00:00:00', '2022-08-17 00:00:00'),
(8, 5, '樹脂粘土で自作のマキバオー。', 'vBAqPJA07z13NrG5ySPmtxQvOQWeyiWXRzJgcvuw.jpg', 'ジャンプ', 'マキバオー', '自作', NULL, NULL, 0, NULL, NULL, NULL, '2022-08-18 00:00:00', '2022-08-18 00:00:00'),
(9, 4, '『THE NEW BATMAN ADVENTURES』のバットマン。\r\nマントパーツが、直立時の固定タイプと布製可動タイプの2つ付属で良い。\r\nフェイスパーツがマスクと素顔の2種類で、他に表情が無いのが残念。', '3o4CtlTUUXzE5saf1xRS2uXM11PnFslOCQ8ymLCw.jpg', 'MAFEX', 'BATMAN', 'アクションフィギュア', NULL, NULL, 0, '4nEzv1SGKpaaQVrxkJqPcusMTZNt8pMY8qOUzmK6.jpg', NULL, NULL, '2022-08-21 00:00:00', '2022-08-23 16:56:18'),
(10, 4, '『THE NEW BATMAN ADVENTURES』のジョーカー。', 'j76RThSj3uHcNtUdyGSNkqD2LwMeUfcJLrv3qQsT.jpg', 'MAFEX', 'BATMAN', 'アクションフィギュア', NULL, NULL, 0, 'V5A4Edb3xFlBAKF5u0pcQkzIzcHti2QYL3MBN8pt.jpg', 'oQBEHhYjkveGmcjmk9dxQPZJfzlrIGI6uS30nI2l.jpg', 'KFH9YxYTYkCfn8guJhY5F65ZUuiMnZwuX9SmjZJs.jpg', '2022-08-21 00:00:00', '2022-08-21 00:00:00'),
(11, 4, 'アニメ『Justice League』のグリーンランタン。2022年4月発売予定のフラッシュが全然リリースされない。リーグメンバー横並びにしたい…。', 'xOoAB8V37c5iOlrly7L6vh3NTyAtKcvVBPAfWelL.jpg', 'HOT TOYS', 'グリーンランタン', 'DCマルチバース', NULL, NULL, 0, NULL, NULL, NULL, '2022-08-21 00:00:00', '2022-08-21 00:00:00'),
(12, 4, '『BATMAN：HUSH』のバットマン、キャットウーマン、スーパーマン、ハッシュ、ジョーカー。ブルース＆セリーナを取り囲むヴィラン的な感じでディスプレイしてます。', 'ivrEIPV9Hl71ob0gPan1Vf34iGn1KYOfZD6IPZnS.jpg', 'MAFEX', 'BATMAN', 'アクションフィギュア', NULL, NULL, 0, 'wBba8MFkrbvXJkLmgtpx04FaXaeeE8fjLh8euY4m.jpg', '3jlLaW9PD86syVcDntamF75kJjBBW7QoAWDkwXky.jpg', 'H8ZbYJoeRxymjNB83sF1Ef2id1zxCx2LpGiTMght.jpg', '2022-08-21 00:00:00', '2022-08-21 00:00:00'),
(13, 4, 'アニメ『ティーンタイタンズ』のサイボーグ。全然他のメンバー来ない。', 'b3QhnqnsZGyebo2CUsFmqYfU9k6OpafahlMF9w0S.jpg', 'HOT TOYS', 'ティーンタイタンズ', 'DCマルチバース', NULL, NULL, 0, NULL, NULL, NULL, '2022-08-21 00:00:00', '2022-08-21 00:00:00'),
(14, 4, 'たまに中古屋でちっちゃい玩具アクションフィギュア買うと楽しい。', 'qLP4oIkjGRo5sJSBvmUtSXZkpv6gRjBDbb2IXcoA.jpg', 'BATMAN', NULL, NULL, NULL, NULL, 0, 'kwozFMIz9xOvfZLy3HMijE9SFzJFTdiD71c0u174.jpg', NULL, NULL, '2022-08-21 00:00:00', '2022-08-21 00:00:00'),
(18, 8, 'D-artsのウォーグレイモンとベルゼブモン。大体セットで写真が残ってた。', 'Gg3VolM2I9V1bWtgLyRsRUu0B2fSDH58ORfEzFhc.jpg', 'デジモン', 'アクションフィギュア', NULL, NULL, NULL, 0, 'FwP6ssZzYTCzafxo02Iw6tlMS2xGX5pnF2mvgX3K.jpg', 'k3HXEN0M8XyOKfOL5jrY1f2C237S2z3SD4651tb8.jpg', NULL, '2022-08-23 00:00:00', '2022-08-23 13:22:15'),
(19, 8, 'NXEDGESTYLEのオメガモン、デュークモン、アルファモン。ノーマルカラーver.', 'YZhBz5JVAdHVzCPDskuk1dX3wrNI7NOTTtJXrwgA.jpg', 'デジモン', NULL, NULL, NULL, NULL, 0, 'uGM31FuB5ZmQ4kEUDoE7KB1x2R5kkQLzFspdb4TM.jpg', NULL, NULL, '2022-08-23 13:21:11', '2022-08-23 13:21:11'),
(20, 8, 'S.H.Figuartsのインペリアルドラモン パラディンモード。', 'Gp2Luu1brfR4BnQiPPlHKHmNRK1JQjofOwkLa6YD.jpg', 'デジモン', 'アクションフィギュア', NULL, NULL, NULL, 0, 'eSu0ByqrEJQjW5qQbNn27N3sGqzEOdCMJDHaGzbs.jpg', NULL, NULL, '2022-08-23 13:24:57', '2022-08-23 13:24:57'),
(21, 5, '初めて触った粘土細工。デュルク・カイト。', 'KJtSupldbRzjCHrXbHPrk9xpsfGD0Q97cdUfxaUf.jpg', '粘土', '自作', NULL, NULL, NULL, 0, 'cDnxFBpPtVeFX8JthZed6tYRvHhDOngzAtcXRCJi.jpg', '7JiFzgSiuydnpYZvp4Z6oNWiBNEJua5fNcUZTltj.jpg', NULL, '2022-08-23 13:34:29', '2022-08-23 13:34:29'),
(22, 5, 'ヴェルディ君。', '8gF5vPupISQOVGWHpu6lcwt5kmlzeXkCpRPJDTgY.jpg', '粘土', '自作', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2022-08-23 13:36:50', '2022-08-23 13:36:50'),
(23, 2, 'TBSのバラエティー『リンカーン』のさまぁ～ずフィギュア。', 'CV6xmOEadqm1zUxeqSBg5kQLnMEfka7Ju0ejim9N.jpg', 'アクションフィギュア', NULL, NULL, NULL, NULL, 0, 'Q2o1drM0NI3tOBabECVn0gh6QL3PKZsbW64Moro5.jpg', NULL, NULL, '2022-08-23 13:44:05', '2022-08-23 13:44:05'),
(24, 2, 'マスターピースのチータス。', 'c2kKT1cj8hVZiKzXUMkGmBXg9pxV8uD4CWp6RPok.jpg', 'アクションフィギュア', 'ビースト', NULL, NULL, NULL, 0, 'FMuzBY5JHA8a0yitOwstJw8Xa6WCneFtl7pEqflv.jpg', 'mkQDhIWLQDbjG9O9YwVKEhphqMXIF1I8LhuszFce.jpg', NULL, '2022-08-23 13:48:34', '2022-08-23 13:48:34'),
(25, 2, 'マスターピースのメガトロン。', 'jsHgboRrCfRshTdQeWADkCZPf9jzHtaWxSUCGQOA.jpg', 'ビースト', 'アクションフィギュア', NULL, NULL, NULL, 0, 'XndjzPUsEgrHZREfORiW0cMdJuWTPilcvweIqTVC.jpg', 'u61Nb30X85Imv00hbHn2GHBH1OTe3X0to0KAswqv.jpg', NULL, '2022-08-23 13:50:30', '2022-08-23 13:50:30'),
(26, 2, '超像可動のスティッキー・フィンガーズとスパイス・ガール。', 'T8eK95uHjJqrqIX6HAGylNi1uqGwN6H8FxS4Uh7I.jpg', 'アクションフィギュア', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2022-08-23 13:56:35', '2022-08-23 13:56:35'),
(27, 2, 'figmaのダイ。', 'k1QUbhuqrPFofC7FlYajmeDAfH67delY79JPB2m6.jpg', 'アクションフィギュア', NULL, NULL, NULL, NULL, 0, 'EP3LklH70OIfwTaFCz8u172v4bVYQC5sAEn8rAUq.jpg', NULL, NULL, '2022-08-23 13:57:59', '2022-08-23 13:57:59'),
(28, 2, 'パイレーツオブカリビアンの呪われた姿。', 'POd1mQviFSQa311eFAqLnLNR64YDVBIcPxUh9Bfw.jpg', 'アクションフィギュア', NULL, NULL, NULL, NULL, 0, 's9L5p0RobEDVasC9DRJRamu94mKq9BRG8DVPK9OA.jpg', 'PEGDi59aWk8xBYQJMmx48Z0snxN1q91T8mVpt1dx.jpg', 'GWcvloKuAN7uCQ4Yd0STUWV3kiLgmZqrvNGQc5tf.jpg', '2022-08-23 14:00:59', '2022-08-23 14:00:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_name` varchar(255) NOT NULL COMMENT 'ユーザ名',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) NOT NULL COMMENT 'パスワード',
  `icon` varchar(255) DEFAULT NULL COMMENT 'アイコン',
  `comment` varchar(255) DEFAULT NULL COMMENT 'コメント',
  `created_at` datetime DEFAULT NULL COMMENT '登録日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時',
  `role` int(11) DEFAULT 1 COMMENT '管理:0 一般:1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `icon`, `comment`, `created_at`, `updated_at`, `role`) VALUES
(1, 'webmaster', 'test@test.com', '$2y$10$iSLsbwkflc28k8uYKAG/H..gWkwdBlu/0poovPjQTndPQ2uEIF0Cm', 'PfPoB7f4v7Bi9xx7CVOoaEdBVrzObTOVVN3KfLiq.png', '管理用ユーザー', NULL, '2022-08-16 13:39:01', 0),
(2, '可動集め', 'test@test.com', '$2y$10$BKKWHYR3iMmARIBpZv2h2eLfE5ub5XtZfC651zdpfOxd.tdqKWWuy', 'wY3DgUDR4ejMf4yr0nRutzVaR0B0P2apSRWe7XUr.jpg', '気に入ったアクションフィギュアを集めてます。', '2022-08-05 12:14:13', '2022-08-23 13:42:25', 1),
(4, 'DC04', 'test@test.com', '$2y$10$.i23x0z3Kwgq8wXsrou2YOYeFCq9GsDtZJNe3kL88lw28iOYqy3Qy', 'dNinLuqwt2qI2Y3cxXYDjiKQCSJ4y6pn1RbzzM0l.jpg', 'DCコミックスのアクションフィギュアを集めています。実写でなくコミックスとアニメ版。', '2022-08-09 05:43:42', '2022-08-23 15:43:05', 1),
(5, '粘土くん', 'test@test.com', '$2y$10$57G5Ol1dFFcMnYjxry856.9qh338rSJlZgFMeBb7Tt.gvXjwE3uQu', '8aDZHp5eVaudugvC13hQbeK68QHCzUrzPBakDLuX.jpg', '粘土こねこね楽しんでいます。', '2022-08-09 05:51:45', '2022-08-23 13:35:28', 1),
(8, '伝説の選ばれしテイマー02', 'test@test.com', '$2y$10$QN4l6S5R0fwzlBfNFAGVu.5ftaqzdWUV6bnJtV5NXr2n32igWBZDC', 'U4vLbNDZ7DRqLs6Aso3OSRoFUIdnDqmdWmKu523W.jpg', 'デジモン関係を集めています。', '2022-08-22 11:39:34', '2022-08-23 12:55:39', 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `favorite_calendar`
--
ALTER TABLE `favorite_calendar`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `favorite_posts`
--
ALTER TABLE `favorite_posts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`user_name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `favorite_calendar`
--
ALTER TABLE `favorite_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=31;

--
-- テーブルの AUTO_INCREMENT `favorite_posts`
--
ALTER TABLE `favorite_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=247;

--
-- テーブルの AUTO_INCREMENT `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=29;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
