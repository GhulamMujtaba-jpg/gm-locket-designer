<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GM Official – Ultimate Locket Studio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">GM Official – Ultimate Locket Studio</div>

<div class="controls">
    <input type="text" id="nameInput" placeholder="Enter Name">
    <select id="shapeSelect">
        <option value="circle">Circle</option>
        <option value="heart">Heart</option>
        <option value="square">Square</option>
        <option value="star">Star</option>
    </select>
    <select id="fontSelect">
        <option value="Playfair Display">Royal</option>
        <option value="Cinzel">Luxury</option>
        <option value="Great Vibes">Signature</option>
        <option value="Montserrat">Modern</option>
    </select>
    <input type="file" id="photoUpload" accept="image/*">
    <select id="mockupSelect">
        <option value="neck">Neck</option>
        <option value="box">Box</option>
        <option value="model">Model</option>
    </select>
    <button onclick="generate300()">Generate 300 Designs</button>
    <button onclick="downloadDesign()">Download HD</button>
</div>

<div class="preview-area" id="previewArea"></div>

<div class="order-form">
<h3>Place Your Order</h3>
<input type="text" id="customerName" placeholder="Your Name">
<input type="tel" id="customerPhone" placeholder="Phone Number">
<input type="text" id="customerAddress" placeholder="Delivery Address">
<select id="orderMaterial">
    <option value="Gold">Gold</option>
    <option value="Silver">Silver</option>
    <option value="Rose Gold">Rose Gold</option>
</select>
<input type="hidden" id="price" value="2500">
<input type="hidden" id="designNameHidden">
<input type="hidden" id="mockupHidden">
<input type="hidden" id="orderIdHidden">
<button onclick="saveOrder()">Save Order</button>
<button onclick="payOnline()">Pay Online</button>
<p id="totalPrice">Price: PKR 2500</p>
</div>

<div class="footer">Premium Locket Designs by GM Official</div>

<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="main.js"></script>
</body>
</html>
