
function getCheckSum(DataToEnc) {
    alert(DataToEnc);

    var chrNum = 0;
    var newNumStr = '';
    var newCal = 0;
    var chkSum = 0;
    var chkNum = 0;
    var c1 = 0;
    var c2 = 0;


    var numLn = DataToEnc.length;
    var p = 1;
    for (var i = 0; i < numLn; i++) {
        chrNum = DataToEnc.substr(i, 1);

        if (p % 2 === 0) { // determine if position is odd or even
            chrNum = chrNum * 1; //MULTIPLY BY 1
        } else {
            chrNum = chrNum * 2; //MULTIPLY BY 2

            if (chrNum >= 10) { //VALUE > 10 THEN ADD TO DIGITS TOGETHER
                var testChrNum = chrNum;
                c1 = chrNum.toString().substr(0, 1);
                c2 = chrNum.toString().substr(1, 1);
                chrNum = parseInt(c1, 10) + parseInt(c2, 10);
                
                alert( 'chrNum: '+testChrNum+'\nc1: '+c1+' c2: '+c2+"\nNew chrNum: "+chrNum);
            }

        }

        newNumStr += chrNum.toString() + "-";
        newCal = newCal + chrNum;

        p++;
    }
    chkSum = 10 - (newCal % 10);
    
    alert("Ecode For OCR A - Mod 10 weight=(2,1)\n\nUsing Number entered: " + DataToEnc + "\nnewNum: " + newNumStr + "\nNew calc: " + newCal + "\nchkSum: " + chkSum + "\n\nIf a new number is >10 like 12 then split to 1+2= 3, use 3\n");
    
    
    return chkSum;
} //End getCheckSum


function pad(num, size) {
    var s = "0000000000000000000000000000000000000" + num;
    return s.substr(s.length - size);
}


function formatData(account, amount) {
    // remove all non digit characters
    var accountNum = account.replace(/\s+/g, '');
    var amountDue = amount.replace(/\D/g, '');

    var pos1 = pad(accountNum, 18); // 18 max number of digit with lead zero
    var pos2 = pad(amountDue, 10); // 10 max number of digit with lead zero
    var DataToEnc = pos1 + pos2;
    var getChkSum = getCheckSum(DataToEnc); // get check digit
    var output = pos1 + ' ' + pos2 + ' ' + getChkSum;
    return output;

}


var accountNum = "  123  45 6";
var amountDue = "       -1,4 abc28.2 5";

var OCR_A_output = formatData(accountNum, amountDue);

alert(OCR_A_output);