-- Start transaction
START TRANSACTION;

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- --------------------------------------------------------

--
-- Table structure for table songs
--

DROP TABLE IF EXISTS songs CASCADE;
CREATE TABLE songs (
  id uuid DEFAULT uuid_generate_v4() PRIMARY KEY,
  title text NOT NULL,
  content text NOT NULL,
  created_at TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table songs
--

INSERT INTO songs (id, title, content) VALUES
('61b94399-9aba-4ea1-8e94-882c9714369c', 'ma chanson', 'Lala lala');

--
-- Table structure for table playlists
--

DROP TABLE IF EXISTS playlists CASCADE;
CREATE TABLE playlists (
  id uuid DEFAULT uuid_generate_v4() PRIMARY KEY,
  title text NOT NULL,
  created_at TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table playlists
--

INSERT INTO playlists (id, title) VALUES
('61b94399-9aba-4ea1-8e94-082c9714369c', 'ma playlist');


--
-- Table structure for table comments
--

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
  id uuid DEFAULT uuid_generate_v4() PRIMARY KEY,
  content text NOT NULL,
  song_id uuid NOT NULL,
   CONSTRAINT fk_song
      FOREIGN KEY(song_id) 
	  REFERENCES songs(id)
);


--
-- Dumping data for table comments
--

INSERT INTO comments (id, content, song_id) VALUES
('61b94399-9aba-4ea1-8e94-882c9714369a', 'oui', '61b94399-9aba-4ea1-8e94-882c9714369c');


-- End transaction
COMMIT;


