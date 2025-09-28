# Diagram Notes and How to Export

This file documents the activity diagrams added to `diagrams/Activity_ECommerce.drawio` and explains how to open and export them using diagrams.net (draw.io).

Diagrams included (in the single `.drawio` file):

- User Registration (existing)
- Place Order (existing)
- Login (added)
- Manage Product (added)
- Search Product (added)
- Add to Cart & Checkout (added)
- View Order & Track Status (added)
- Report Generation (added)

How to open the diagrams:
1. Go to https://app.diagrams.net/ (diagrams.net) or open the desktop app if installed.
2. Choose File → Open from Device and select `diagrams/Activity_ECommerce.drawio` from this repository.
3. The file contains multiple diagrams. Use the left-hand drop-down in diagrams.net (the page selector) to choose the diagram you want to view.

How to export a single diagram to PNG/PDF:
1. Open the diagram you want to export (select it from the diagram selector in the top-left).
2. File → Export as → PNG
   - Choose options: "Include a copy of my diagram" unchecked (optional), scale 1, transparent background false.
   - Click Export and save into `diagrams/exports/` (create the folder if it doesn't exist).
3. Or File → Export as → PDF
   - Choose paper size and margins as needed, click Export and save.

Recommended exports for submission:
- Export each diagram as a PNG (one file per diagram) and place them in `diagrams/exports/png/`.
- Optionally export a combined PDF with one diagram per page in `diagrams/exports/pdf/`.

Naming convention suggestion:
- `activity_login.png`
- `activity_manage_product.png`
- `activity_search_product.png`
- `activity_cart_checkout.png`
- `activity_view_order.png`
- `activity_report_generation.png`

Notes and small descriptions (short):
- Login: Covers user login flow including validation and error handling.
- Manage Product: Admin/product manager flows for add/edit/delete product and image handling.
- Search Product: Customer search flow including filter and pagination.
- Add to Cart & Checkout: Cart management, address selection, shipping calculation, payment initiation.
- View Order & Track Status: Customer order history, details, and tracking statuses.
- Report Generation: Admin reports for sales, orders, and products.

If you'd like, I can export the diagrams for you and add the PNG/PDF files into `diagrams/exports/`. Confirm and I'll proceed.
