-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `blog_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `posted_at` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `anon_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author`, `content`, `posted_at`, `status`, `anon_username`) VALUES
(78, 2, 8, 'Un nouveau commentaire', '2018-06-11 16:22:52', 'PUBLISHED', NULL),
(80, 37, 8, 'Un article bien intéressant ', '2018-06-11 16:23:12', 'PUBLISHED', NULL),
(85, 48, NULL, 'Lorem Ipsum ', '2018-06-11 20:19:10', 'PUBLISHED', 'Jessica'),
(86, 4, NULL, 'Lorem ipsum', '2018-06-11 20:19:41', 'PUBLISHED', 'Rachid');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`id`, `author`, `title`, `subtitle`, `content`, `updated_at`, `image_url`) VALUES
(2, 3, 'Sunt in quae a dissentientiumm', 'Transferri ut statuit suppliciter diffusa ut non mos specie Hierapolim', 'Et olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina suscipitur et regina et ubique patrum reverenda cum auctoritate canities populique Romani nomen circumspectum et verecundum.\r\n\r\nOb haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malis dissimulatis paulatimque serpentibus acervi crescerent aerumnarum, nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulari Minervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur.\r\n\r\nEtenim si attendere diligenter, existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum quemquam ad hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum spei fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino, humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel pietatis vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est resistendum.\r\n\r\nDuplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.\r\n\r\nQui cum venisset ob haec festinatis itineribus Antiochiam, praestrictis palatii ianuis, contempto Caesare, quem videri decuerat, ad praetorium cum pompa sollemni perrexit morbosque diu causatus nec regiam introiit nec processit in publicum, sed abditus multa in eius moliebatur exitium addens quaedam relationibus supervacua, quas subinde dimittebat ad principem.\r\n\r\nHaec ubi latius fama vulgasset missaeque relationes adsiduae Gallum Caesarem permovissent, quoniam magister equitum longius ea tempestate distinebatur, iussus comes orientis Nebridius contractis undique militaribus copiis ad eximendam periculo civitatem amplam et oportunam studio properabat ingenti, quo cognito abscessere latrones nulla re amplius memorabili gesta, dispersique ut solent avia montium petiere celsorum.\r\n\r\nFuerit toto in consulatu sine provincia, cui fuerit, antequam designatus est, decreta provincia. Sortietur an non? Nam et non sortiri absurdum est, et, quod sortitus sis, non habere. Proficiscetur paludatus? Quo? Quo pervenire ante certam diem non licebit. ianuario, Februario, provinciam non habebit; Kalendis ei denique Martiis nascetur repente provincia.', '2018-06-11 17:39:25', 'images/brooke-lark-194251.jpg'),
(4, 2, 'Maerens angorem super verissime verni', 'Est ab modo cum est adliciat propter ducibus et crudelitatem', 'Quare talis improborum consensio non modo excusatione amicitiae tegenda non est sed potius supplicio omni vindicanda est, ut ne quis concessum putet amicum vel bellum patriae inferentem sequi; quod quidem, ut res ire coepit, haud scio an aliquando futurum sit. Mihi autem non minori curae est, qualis res publica post mortem meam futura, quam qualis hodie sit.\r\n\r\nQuam ob rem ut ii qui superiores sunt submittere se debent in amicitia, sic quodam modo inferiores extollere. Sunt enim quidam qui molestas amicitias faciunt, cum ipsi se contemni putant; quod non fere contingit nisi iis qui etiam contemnendos se arbitrantur; qui hac opinione non modo verbis sed etiam opere levandi sunt.\r\n\r\nHis cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.\r\n\r\nSed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.', '2018-04-30 15:21:29', ''),
(37, 8, 'Eum fugiat quo voluptas nulla pariatur', 'Quis autem vel eum iure reprehenderit pariatur', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. \r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. \r\n\r\nNeque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? \r\n\r\nQuis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2018-05-07 18:49:56', ''),
(48, 8, 'Parturient justo pretium at magnis curae', 'Pretium amet nostra turpis proin class tempus semper', 'Pretium amet nostra turpis proin class tempus semper quis aenean urna duis mi. Turpis aliquam. Cras.\r\n\r\nSemper ac ridiculus vel risus enim inceptos, litora id bibendum dictum fermentum luctus risus class rhoncus amet pulvinar condimentum vestibulum augue curae; iaculis dapibus rutrum inceptos at erat. Dis urna semper vulputate erat. Elementum justo arcu sapien justo viverra sollicitudin.\r\n\r\nSuscipit hac. Facilisi ligula sagittis tristique a arcu nibh metus et dictumst Leo elementum natoque consequat placerat senectus pede auctor luctus arcu nec curae; porta. Ullamcorper at class pharetra risus dictum. Pulvinar montes porta montes pede enim aliquet bibendum, bibendum. Elit aenean. Lacus rutrum.', '2018-06-11 17:40:39', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`) VALUES
(2, 'Samantha', 'Vossar', 'samvossar', 'sam.vossar@gmail.com', '0a0928a261928bb5d9d02fae875b1c7d2f964d24', 'REGISTERED_USER'),
(3, 'Sally', 'Burns', 'sally', 'sally_burns@gmail.com', 'fc80b22ff203a1a88470b19ab19228044d066d66', 'REGISTERED_USER'),
(8, 'Amélie', 'Haladjian', 'dzov', 'amelie2360@gmail.com', 'ae36a599bf6b28832664e11ed025045bec29da52', 'ADMIN'),
(9, 'Gregory', 'Sanders', 'gregs', 'greg@gmail.com', '79e2475f81a6317276bf7cbb3958b20d289b78df', 'REGISTERED_USER'),
(10, 'Nicole', 'Jackson', 'Nicole', 'n.jackson@g.com', '5fee00239940f883d4c2854e41c7f989e75278a3', 'REGISTERED_USER');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`author`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_user_id` (`author`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`),
  ADD UNIQUE KEY `UC_user` (`username`,`email`),
  ADD UNIQUE KEY `username_2` (`username`,`email`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD UNIQUE KEY `username_4` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `admin_user_id` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
