function C_HighLight(code, language) {
    //哈希表类
    function Hashtable() {
        this._hash = new Object();
        this.add = function (key, value) {
            if (typeof (key) != "undefined") {
                if (this.contains(key) == false) {
                    this._hash[key] = typeof (value) == "undefined" ? null : value;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        this.remove = function (key) { delete this._hash[key]; }
        this.count = function () { var i = 0; for (var k in this._hash) { i++; } return i; }
        this.items = function (key) { return this._hash[key]; }
        this.contains = function (key) { return typeof (this._hash[key]) != "undefined"; }
        this.clear = function () { for (var k in this._hash) { delete this._hash[k]; } }
    }
    //字符串转换为哈希表
    this.str2hashtable = function (key, cs) {
        var _key = key.split(/,/g);
        var _hash = new Hashtable();
        var _cs = true;
        if (typeof (cs) == "undefined") {
            _cs = this._caseSensitive;
        } else {
            _cs = cs;
        }
        for (var i in _key) {
            if (_cs) {
                _hash.add(_key[i]);
            } else {
                _hash.add((_key[i] + "").toLowerCase());
            }
        }
        return _hash;
    }
    //获得需要转换的代码
    this._codetxt = code;
    if (typeof (language) == "undefined") {

        language = "";
    }

    switch (language.toLowerCase()) {
        case "c":
        case "cpp":
            //是否大小写敏感
            this._caseSensitive = true;
            //得到关键字哈希表
            this._keywords = this.str2hashtable("auto,bool,break,case,char,class,const,continue,default,do,double,else,enum,extern,false,float,for,goto,if,int,long,namespace,new,null,object,operator,private,protected,public,return,short,sizeof,static,struct,switch,this,throw,true,try,using,virtual,void,volatile,while");
            //预处理
            this._preo = this.str2hashtable("include,define,defined,else,elif,endif,ifdef,ifndef,pragma,undef");
            //预处理的开始
            this._pm = "#";
            //需要加空格的分割字符
            this._asDelim = this.str2hashtable("+,-,*,/,%,=,|,&,^,~,.,?,:");
            //得到内建对象哈希表
            this._commonObjects = this.str2hashtable("");
            //标记
            this._tags = this.str2hashtable("", false);
            //得到分割字符
            this._wordDelimiters = "　 ,.?!;:\\/<>(){}[]\"'\r\n\t=+-|*%@#$^&";
            //引用字符
            this._quotation = this.str2hashtable("\",\'");
            //行注释字符
            this._lineComment = "//";
            //转义字符
            this._escape = "\\";
            //多行引用开始
            this._commentOn = "/*";
            //多行引用结束
            this._commentOff = "*/";
            //忽略词
            this._ignore = "";
            //是否处理标记
            this._dealTag = false;
            break;


        default:
            //是否大小写敏感
            this._caseSensitive = true;
            //得到关键字哈希表
            this._keywords = this.str2hashtable("auto,bool,break,case,char,class,const,continue,default,do,double,else,enum,extern,false,float,for,goto,if,int,long,namespace,new,null,object,operator,private,protected,public,return,short,sizeof,static,struct,switch,this,throw,true,try,using,virtual,void,volatile,while");
            //得到内建对象哈希表
            this._commonObjects = this.str2hashtable("");
            //标记
            this._tags = this.str2hashtable("", false);
            //得到分割字符
            this._wordDelimiters = "　 ,.?!;:\\/<>(){}[]\"'\r\n\t=+-|*%@#$^&";
            //引用字符
            this._quotation = this.str2hashtable("\",\'");
            //行注释字符
            this._lineComment = "//";
            //转义字符
            this._escape = "\\";
            //多行引用开始
            this._commentOn = "/*";
            //多行引用结束
            this._commentOff = "*/";
            //忽略词
            this._ignore = "";
            //是否处理标记
            this._dealTag = false;
            break;
    }
    this.highlight = function () {
        var codeArr = new Array();
        var word_index = 0;
        var htmlTxt = new Array();
        //得到分割字符数组(分词)
        for (var i = 0; i < this._codetxt.length; i++) {
            if (this._wordDelimiters.indexOf(this._codetxt.charAt(i)) == -1) {        //找不到关键字
                if (codeArr[word_index] == null || typeof (codeArr[word_index]) == 'undefined') {
                    codeArr[word_index] = "";
                }
                codeArr[word_index] += this._codetxt.charAt(i);
            } else {
                if (typeof (codeArr[word_index]) != 'undefined' && codeArr[word_index].length > 0)
                    word_index++;
                codeArr[word_index++] = this._codetxt.charAt(i);
            }
        }
        var quote_opened = false;                  //引用标记
        var slash_star_comment_opened = false;     //多行注释标记
        var slash_slash_comment_opened = false;    //单行注释标记
        var line_num = 1;                          //行号
        var quote_char = "";                       //引用标记类型
        var tag_opened = false;                    //标记开始
        var sharp_opened = false;                  //#号标记

        //background-color:#a0d0b4
        htmlTxt[htmlTxt.length] = ("<div style='font-family: Courier New; align-content:space-between; font-size:12px; overflow:auto;border-width:1px;border-style:solid; border-color:#8a8a8a;border-bottom-color:#8a8a8a; background-color:rgb(249,249,249); margin:1px;padding:6px;'>");

        //按分割字，分块显示
        for (var i = 0; i <= word_index; i++) {
            //处理空行（由于转义带来）
            if (typeof (codeArr[i]) == "undefined" || codeArr[i].length == 0) {
                continue;
            }
            //处理关键字
            if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && this.isKeyword(codeArr[i])) {
                htmlTxt[htmlTxt.length] = ("<span style='color:rgb(0,0,255);'>" + codeArr[i] + "</span>");
                //处理普通对象
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && this.isCommonObject(codeArr[i])) {
                htmlTxt[htmlTxt.length] = ("<span style='color:rgb(0,128,255);'>" + codeArr[i] + "</span>");
                //处理标记
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && tag_opened && this.isTag(codeArr[i])) {
                htmlTxt[htmlTxt.length] = ("<span style='color:rgb(128,0,0);'>" + codeArr[i] + "</span>");
                //处理换行
            } else if (codeArr[i] == "\n") {
                if (slash_slash_comment_opened) {
                    htmlTxt[htmlTxt.length] = ("</span></b>");
                    slash_slash_comment_opened = false;
                } else if (sharp_opened) {
                    htmlTxt[htmlTxt.length] = ("</span>");
                    sharp_opened = false;
                }
                htmlTxt[htmlTxt.length] = ("<br/>");
                line_num++;
                //处理双引号（引号前不能为转义字符）
            } else if (this._quotation.contains(codeArr[i]) && !slash_star_comment_opened && !slash_slash_comment_opened) {
                if (quote_opened) {
                    //是相应的引号
                    if (quote_char == codeArr[i]) {
                        if (tag_opened) {
                            htmlTxt[htmlTxt.length] = (codeArr[i] + "</span><span style='rgb(0,128,0);'>");
                        } else {
                            htmlTxt[htmlTxt.length] = (codeArr[i] + "</span>");
                        }
                        quote_opened = false;
                        quote_char = "";
                    } else {
                        htmlTxt[htmlTxt.length] = codeArr[i].replace(/\</g, "&lt;");
                    }
                } else {
                    if (tag_opened) {
                        htmlTxt[htmlTxt.length] = ("</span></b><b><span style='color:rgb(0,128,0);'>" + codeArr[i]);
                    } else {
                        htmlTxt[htmlTxt.length] = ("<span style='color:rgb(0,128,0);'>" + codeArr[i]);
                    }
                    quote_opened = true;
                    quote_char = codeArr[i];
                }
                //处理转义字符
            } else if (codeArr[i] == this._escape) {
                htmlTxt[htmlTxt.length] = (codeArr[i]);
                if (i < word_index - 1) {
                    if (codeArr[i + 1].charCodeAt(0) >= 32 && codeArr[i + 1].charCodeAt(0) <= 127) {
                        htmlTxt[htmlTxt.length] = codeArr[i + 1].substr(0, 1).replace("&", "&amp;").replace(/\</g, "&lt;");
                        codeArr[i + 1] = codeArr[i + 1].substr(1);
                    }
                }
                //预处理指令开始
            } else if (this.isStartWith(this._pm, codeArr, i) && !slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened) {
                sharp_opened = true;
                htmlTxt[htmlTxt.length] = ("<span style='color:rgb(0,0,255);'>" + codeArr[i]);
                //处理多行注释的开始
            } else if (this.isStartWith(this._commentOn, codeArr, i) && !slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened) {
                slash_star_comment_opened = true;
                htmlTxt[htmlTxt.length] = ("<b><span style='color:rgb(0,128,0);'>" + this._commentOn.replace(/\</g, "&lt"));
                i = i + this._commentOn.length - 1;
                //处理单行注释
            } else if (this.isStartWith(this._lineComment, codeArr, i) && !slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened) {
                slash_slash_comment_opened = true;
                htmlTxt[htmlTxt.length] = ("<b><span style='color:rgb(0,128,0);'>" + this._lineComment);
                i = i + this._lineComment.length - 1;
                //处理忽略词
            } else if (this.isStartWith(this._ignore, codeArr, i) && !slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened) {
                slash_slash_comment_opened = true;
                htmlTxt[htmlTxt.length] = ("<span style='color:rgb(0,128,0);'>" + this._ignore.replace(/\</g, "&lt"));
                i = i + this._ignore.length - 1;
                //处理多行注释结束
            } else if (this.isStartWith(this._commentOff, codeArr, i) && !quote_opened && !slash_slash_comment_opened) {
                if (slash_star_comment_opened) {
                    slash_star_comment_opened = false;
                    htmlTxt[htmlTxt.length] = (this._commentOff + "</span></b>");
                    i = i + this._commentOff.length - 1;
                }
                //处理左标记
            } else if (this._dealTag && !slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && codeArr[i] == "<") {
                //预处理指令里的左标记
                if (sharp_opened) {
                    htmlTxt[htmlTxt.length] = "<span style='color:rgb(0,0,255);'>&lt;" + codeArr[i];
                    tag_opened = true;
                } else {
                    htmlTxt[htmlTxt.length] = "<span style='color:rgb(0, 190, 190);'>&lt;" + codeArr[i];
                }
                //处理右标记
            } else if (this._dealTag && tag_opened && codeArr[i] == ">") {
                htmlTxt[htmlTxt.length] = "&gt;</span>";
                tag_opened = false;
                //处理HTML转义符号
            }
/*			else if (codeArr[i] == "&") {
                htmlTxt[htmlTxt.length] = "&amp;";
                //处理分隔
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && this.isAsDelim(codeArr[i]) && !sharp_opened) {
                htmlTxt[htmlTxt.length] = ("&nbsp;" + codeArr[i] + "&nbsp;");
                //处理分号
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && codeArr[i] == ";") {
                htmlTxt[htmlTxt.length] = ("&nbsp;;");
                //处理逗号
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && codeArr[i] == ",") {
                htmlTxt[htmlTxt.length] = (",&nbsp;");
                //处理空格
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && codeArr[i] == " ") {
               htmlTxt[htmlTxt.length] = ("&nbsp;");
                //处理Tab
            } else if (!slash_slash_comment_opened && !slash_star_comment_opened && !quote_opened && codeArr[i] == "\t") {
                htmlTxt[htmlTxt.length] = ("&nbsp;&nbsp;&nbsp;&nbsp;");
           } */
			else {
                htmlTxt[htmlTxt.length] = codeArr[i].replace(/\</g, "&lt;");
            }
        }
        htmlTxt[htmlTxt.length] = ("</div>");
        return htmlTxt.join("");
    }
    this.isStartWith = function (str, code, index) {
        if (typeof (str) != "undefined" && str.length > 0) {
            for (var i = 0; i < str.length; i++) {
                if (this._caseSensitive) {
                    if (str.charAt(i) != code[index + i] || (index + i >= code.length)) {
                        return false;
                    }
                } else {
                    if (str.charAt(i).toLowerCase() != code[index + i].toLowerCase() || (index + i >= code.length)) {
                        return false;
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }
    this.showLineNum = function (num) {
        var lineNumArr = new Array();
        lineNumArr[lineNumArr.length] = ("<div style='font-size:12px;border-width:1px;border-style:solid;border-color:rgb(10,130,240);background-color:rgb(249,249,249);margin:1px;padding:6px;'>");
        lineNumArr[lineNumArr.length] = ("</div>");
        document.getElementById("showLineNum").innerHTML = lineNumArr;
    }
    this.isAsDelim = function (val) {
        return this._asDelim.contains(val);
    }
    this.isPreo = function (val) {
        return this._preo.contains(val);
    }
    this.isKeyword = function (val) {
        return this._keywords.contains(this._caseSensitive ? val : val.toLowerCase());
    }
    this.isCommonObject = function (val) {
        return this._commonObjects.contains(this._caseSensitive ? val : val.toLowerCase());
    }
    this.isTag = function (val) {
        return this._tags.contains(val.toLowerCase());
    }
}
//显示高亮代码
function showHighLight() {
    var code = document.getElementById("txt-content").value;
    var lang = document.getElementById("language").value;
    var hl = new C_HighLight(code, lang);
    if (hl.highlight().length == 0) {
        return false;
    }
    document.getElementById("showHighLight").innerHTML = hl.highlight();
}
//生成高亮代码
function generateHighlight(code,lang) {

    var hl = new C_HighLight(code, lang);
    return hl.highlight();
}
//清空代码
function clearCode() {
    var code_elem = document.getElementById("txt-content");
    if (code_elem.value.length > 0) {
        code_elem.innerHTML = "";
    }
}
