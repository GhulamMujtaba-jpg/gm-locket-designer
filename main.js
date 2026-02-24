const previewArea=document.getElementById("previewArea");
const shapes=["circle","heart","square","star"];
const fonts=["Playfair Display","Cinzel","Great Vibes","Montserrat"];
const mockups={
    neck:"mockups/neck.png",
    box:"mockups/box.png",
    model:"mockups/model.png"
};
function randomColor(){return `hsl(${Math.floor(Math.random()*360)},${Math.floor(Math.random()*50)+50}%,${Math.floor(Math.random()*30)+40}%)`;}
function createLocket(name,shape,font,photo,mockupType){
    let div=document.createElement("div");
    div.className="locket "+shape;
    div.style.fontFamily=font;
    div.style.background=randomColor();
    let img=document.createElement("img");
    img.src=mockups[mockupType]||mockups.neck;
    img.className="mockup";
    div.appendChild(img);
    if(photo){
        let userPhoto=document.createElement("img");
        userPhoto.src=photo;
        userPhoto.className="mockup";
        div.appendChild(userPhoto);
    }
    let shine=document.createElement("div"); shine.className="shine"; div.appendChild(shine);
    let span=document.createElement("span"); span.className="text"; span.innerText=name; div.appendChild(span);
    return div;
}
function generate300(){
    previewArea.innerHTML="";
    let name=document.getElementById("nameInput").value||"GM";
    document.getElementById("designNameHidden").value=name;
    let photo=document.getElementById("photoUpload").files[0]?URL.createObjectURL(document.getElementById("photoUpload").files[0]):null;
    let mockup=document.getElementById("mockupSelect").value;
    document.getElementById("mockupHidden").value=mockup;
    let used=new Set();
    let count=0;
    while(count<300){
        let s=shapes[Math.floor(Math.random()*shapes.length)];
        let f=fonts[Math.floor(Math.random()*fonts.length)];
        let key=s+"|"+f+"|"+Math.floor(Math.random()*360);
        if(used.has(key)) continue;
        used.add(key);
        let l=createLocket(name,s,f,photo,mockup);
        l.style.transform="rotateY("+((Math.random()*60)-30)+"deg)";
        previewArea.appendChild(l);
        count++;
    }
}
function updatePrice(){
    let material=document.getElementById("orderMaterial").value;
    let price=0;
    if(material=="Gold") price=2500;
    else if(material=="Silver") price=1800;
    else if(material=="Rose Gold") price=2200;
    document.getElementById("totalPrice").innerText="Price: PKR "+price;
    document.getElementById("price").value=price;
}
document.getElementById("orderMaterial").onchange=updatePrice;
updatePrice();
function downloadDesign(){
    let first=previewArea.firstChild;
    if(!first) first=createLocket("GM","circle","Montserrat",null,"neck");
    html2canvas(first,{scale:4}).then(canvas=>{
        let link=document.createElement("a");
        link.download="GM_Locket_HD.png";
        link.href=canvas.toDataURL();
        link.click();
    });
}
function saveOrder(){
    let formData=new FormData();
    formData.append("customerName",document.getElementById("customerName").value);
    formData.append("customerPhone",document.getElementById("customerPhone").value);
    formData.append("customerAddress",document.getElementById("customerAddress").value);
    formData.append("orderMaterial",document.getElementById("orderMaterial").value);
    formData.append("designName",document.getElementById("designNameHidden").value);
    formData.append("mockupType",document.getElementById("mockupHidden").value);
    let photoFile=document.getElementById("photoUpload").files[0];
    if(photoFile) formData.append("photo",photoFile);
    formData.append("price",document.getElementById("price").value);
    fetch("save_order.php",{method:"POST",body:formData})
    .then(res=>res.json())
    .then(data=>{
        alert(data.message);
        if(data.status=="success"){
            document.getElementById("orderIdHidden").value=data.order_id;
        }
    })
    .catch(err=>{alert("Failed to save order");});
}
function payOnline(){
    let orderId=document.getElementById("orderIdHidden").value;
    let price=document.getElementById("price").value;
    if(!orderId){alert("Save order first!"); return;}
    alert(`Redirecting to payment gateway for Order ID: ${orderId}, Amount: PKR ${price}`);
}
