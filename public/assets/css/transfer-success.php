body{

margin:0;
padding:0;

background:#f5f7fb;

font-family:Arial,sans-serif;

display:flex;

justify-content:center;

align-items:center;

min-height:100vh;

}

.success-container{

width:100%;
padding:20px;

display:flex;

justify-content:center;

}

.success-card{

width:100%;
max-width:420px;

background:#fff;

border-radius:25px;

padding:35px 25px;

box-shadow:0 10px 35px rgba(0,0,0,.08);

animation:pop .35s ease;

}

.success-icon{

width:90px;

height:90px;

margin:auto;

border-radius:50%;

background:linear-gradient(135deg,#6b2cff,#8c52ff);

display:flex;

justify-content:center;

align-items:center;

color:#fff;

font-size:42px;

box-shadow:0 8px 25px rgba(107,44,255,.35);

}

.success-card h2{

text-align:center;

margin:20px 0 10px;

font-size:32px;

color:#222;

}

.amount{

text-align:center;

font-size:38px;

font-weight:bold;

color:#6b2cff;

margin-bottom:10px;

}

.subtitle{

text-align:center;

color:#777;

margin-bottom:30px;

}

.receipt{

border-top:1px solid #eee;

border-bottom:1px solid #eee;

padding:15px 0;

}

.receipt-row{

display:flex;

justify-content:space-between;

padding:15px 0;

border-bottom:1px solid #f3f3f3;

}

.receipt-row:last-child{

border-bottom:none;

}

.receipt-row span{

color:#777;

}

.receipt-row strong{

color:#222;

text-align:right;

}

.buttons{

margin-top:30px;

display:flex;

flex-direction:column;

gap:15px;

}

.share-btn{

height:55px;

border:none;

border-radius:15px;

background:#ece6ff;

color:#6b2cff;

font-size:16px;

font-weight:bold;

cursor:pointer;

}

.done-btn{

height:55px;

display:flex;

justify-content:center;

align-items:center;

gap:10px;

text-decoration:none;

border-radius:15px;

background:linear-gradient(135deg,#6b2cff,#8c52ff);

color:#fff;

font-size:16px;

font-weight:bold;

}

@keyframes pop{

0%{

transform:scale(.85);

opacity:0;

}

100%{

transform:scale(1);

opacity:1;

}

}
