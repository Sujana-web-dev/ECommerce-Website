-- SQL script to add missing columns to cart_items table
-- Run this in your database management tool (phpMyAdmin, MySQL Workbench, etc.)

-- Add price column if it doesn't exist
ALTER TABLE cart_items ADD COLUMN IF NOT EXISTS price DECIMAL(10,2) NULL AFTER quantity;

-- Add options column if it doesn't exist  
ALTER TABLE cart_items ADD COLUMN IF NOT EXISTS options JSON NULL AFTER price;

-- Verify the table structure
DESCRIBE cart_items;
