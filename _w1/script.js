document.getElementsByTagName("form").onsubmit = function () {
    return false;
};

function crossProduct(p1, p2, p3) {

    var dx1 = p2.x - p1.x;
    var dy1 = p2.y - p1.y;
    var dx2 = p3.x - p2.x;
    var dy2 = p3.y - p2.y;

    var zcrossproduct = dx1 * dy2 - dy1 * dx2;
    return zcrossproduct;
}

function check1() {
    var ABC, BCD, CDA, DAB;

    var Xa = document.getElementById("xa").value;
    var Ya = document.getElementById("ya").value;
    var Xb = document.getElementById("xb").value;
    var Yb = document.getElementById("yb").value;
    var Xc = document.getElementById("xc").value;
    var Yc = document.getElementById("yc").value;
    var Xd = document.getElementById("xd").value;
    var Yd = document.getElementById("yd").value;
    /* 
        dx1 = P1.x - P0.x;
        dx2 = P2.x - P0.x;
        dy1 = P1.y - P0.y;
        dy2 = P2.y - P0.y;
        CP = dx1 * dy2 - dx2 * dy1;
    */
    A = {x: Xa, y: Ya};
    B = {x: Xb, y: Yb};
    C = {x: Xc, y: Yc};
    D = {x: Xd, y: Yd};
    
    /*ABC = (Xb - Xa) * (Yc - Yb) - (Yb - Ya) * (Xc - Xb);
    BCD = (Xc - Xb) * (Yd - Yc) - (Yc - Yb) * (Xd - Xc);
    CDA = (Xd - Xc) * (Ya - Yd) - (Yd - Yc) * (Xa - Xd);
    DAB = (Xa - Xd) * (Yb - Ya) - (Ya - Yd) * (Xb - Xa);*/

    ABC = crossProduct(A, B, C);
    BCD = crossProduct(B, C, D);
    CDA = crossProduct(C, D, A);
    DAB = crossProduct(D, A, B);

    alert(ABC+" "+BCD+" "+CDA+" "+DAB);

    if (ABC > 0 && BCD > 0 && CDA > 0 && DAB > 0) {
        alert("Tứ giác là tứ giác lồi");
    } else if (ABC < 0 && BCD < 0 && CDA < 0 && DAB < 0) {
        alert("Tứ giác là tứ giác lồi");
    } else if (ABC == 0 || BCD == 0 || CDA == 0 || DAB == 0) {
        alert("Có ít nhất 3 điểm thẳng hàng => Không phải là tứ giác");
    } else alert("Tứ giác là tứ giác lõm");
}

function check2() {
    var Xp = parseInt(document.getElementById("xp").value);
    var Yp = parseInt(document.getElementById("yp").value);
    if (Xp <= 0) {
        if ((Xp) * (Xp) + (Yp) * (Yp) - 4 <= 0)
            alert("Điểm P thuộc miền chéo");
        else
            alert("Điểm P không thuộc miền chéo");
    } else {
        if (Yp >= 0) {
            if (Xp + 3 * Yp - 6 <= 0) alert("Điểm P thuộc miền chéo");
            else alert("Điểm P không thuộc miền chéo");
        } else {
            if (Xp - 3 * Yp - 6 <= 0) alert("Điểm P thuộc miền chéo");
            else alert("Điểm P không thuộc miền chéo");
        }
    }
}

function Find() {
    var result = "";
    var temp = "";
    var lth = 1;
    var str = document.getElementById("str").value;
    temp = temp + str[0];
    result = temp;

    for (i = 1; i < str.length; i++) {
        if (str[i] < str[i - 1]) {
            temp = temp + str[i];
            if (lth < temp.length) lth = temp.length;
        } else {
            temp = str[i];
        }
    }
    alert(lth);
    
    temp = str[0];
    if (lth == 1) result = str[0];
    else result = "";
    for (i = 1; i < str.length; i++) {
        if (str[i] < str[i - 1]) {
            temp = temp + str[i];
        } else {
            temp = str[i];
        }
        if (temp.length == lth) result = result + " " + temp;
    }
    alert(result);
}