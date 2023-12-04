-- Start transaction
START TRANSACTION;

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- --------------------------------------------------------

--
-- Table structure for table items
--

DROP TABLE IF EXISTS items CASCADE;
CREATE TABLE items (
  id uuid DEFAULT uuid_generate_v4() PRIMARY KEY,
  title text NOT NULL,
  content text NOT NULL,
  created_at TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table items
--

INSERT INTO items (id, title, content) VALUES
('61b94399-9aba-4ea1-8e94-882c9714369c', 'titre', 'contenu');

--
-- Table structure for table comments
--

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
  id uuid DEFAULT uuid_generate_v4() PRIMARY KEY,
  content text NOT NULL,
  item_id uuid NOT NULL,
   CONSTRAINT fk_item
      FOREIGN KEY(item_id) 
	  REFERENCES items(id)
);


--
-- Dumping data for table comments
--

INSERT INTO comments (id, content, item_id) VALUES
('61b94399-9aba-4ea1-8e94-882c9714369a', 'oui', '61b94399-9aba-4ea1-8e94-882c9714369c');


-- End transaction
COMMIT;


