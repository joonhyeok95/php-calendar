CREATE TABLE calendar_background (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year INT NOT NULL,
  month INT NOT NULL,
  image_url VARCHAR(255) NOT NULL,
  opacity FLOAT DEFAULT 0.3, -- 투명도 0.0 ~ 1.0
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY year_month_unique (year, month)
);
