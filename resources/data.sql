--
-- Structure de la table 'comment'
--

CREATE TABLE 'comment' (
  'id' int(11) NOT NULL,
  'post_id' int(11) NOT NULL,
  'author' int(11) NOT NULL,
  'content' text NOT NULL,
  'posted_at' datetime NOT NULL,
  'status' varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table 'comment'
--

INSERT INTO 'comment' ('id', 'post_id', 'author', 'content', 'posted_at', 'status') VALUES
(78, 2, 8, 'Un nouveau commentaire', '2018-06-11 16:22:52', 'PUBLISHED'),
(79, 37, 8, 'Un commentaire', '2018-06-11 16:23:01', 'PUBLISHED'),
(80, 37, 8, 'Un article bien intéressant ', '2018-06-11 16:23:12', 'PUBLISHED'),
(81, 4, 8, 'Bravo ', '2018-06-11 16:23:28', 'PUBLISHED'),
(82, 4, 3, 'Très intéressant', '2018-06-11 16:24:18', 'PUBLISHED');

--
-- Index pour les tables exportées
--

--
-- Index pour la table 'comment'
--
ALTER TABLE 'comment'
  ADD PRIMARY KEY ('id'),
  ADD KEY 'post_id' ('post_id'),
  ADD KEY 'user_id' ('author');

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table 'comment'
--
ALTER TABLE 'comment'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table 'comment'
--
ALTER TABLE 'comment'
  ADD CONSTRAINT 'post_id' FOREIGN KEY ('post_id') REFERENCES 'post' ('id') ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT 'user_id' FOREIGN KEY ('author') REFERENCES 'user' ('id') ON DELETE CASCADE ON UPDATE CASCADE;
