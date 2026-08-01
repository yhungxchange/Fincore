.pin-section{
display:flex;
justify-content:center;
margin-top:30px;
}

.pin-card{
width:100%;
max-width:550px;
background:#fff;
padding:30px;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.pin-card h2{
margin-bottom:25px;
text-align:center;
color:#222;
}

.pin-card label{
display:block;
margin-top:18px;
margin-bottom:8px;
font-weight:600;
color:#444;
}

.pin-card input{
width:100%;
padding:15px;
border:1px solid #ddd;
border-radius:12px;
font-size:15px;
outline:none;
transition:.3s;
}

.pin-card input:focus{
border-color:#6C2BD9;
}

.save-btn{
width:100%;
margin-top:30px;
padding:16px;
border:none;
border-radius:12px;
background:#6C2BD9;
color:#fff;
font-size:16px;
font-weight:600;
cursor:pointer;
transition:.3s;
}

.save-btn:hover{
background:#5521ad;
}

.alert{
padding:14px;
margin-bottom:20px;
border-radius:10px;
text-align:center;
font-weight:600;
}

.alert.error{
background:#ffe5e5;
color:#d11a2a;
}

@media(max-width:768px){

.pin-card{
padding:20px;
}

}
