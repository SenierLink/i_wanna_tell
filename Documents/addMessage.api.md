# api\_name:

api/message/add

# url:

http::/i\_wanna\_tell/app/pulic/api.php/message/add

# method:

POST

# header:

content-type:application/json;charset=utf-8

# body:

json后的数组

[

    title:string message的标题，

    content:string message的内容,

    message\_kind:str message种类，

    author\_id:str message作者的id，        

]

# return:

    isSuccessfuladd:str "1" or "0" 是否成功添加数据到数据库。

# example:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>addMessageTest</title>
</head>
<body>
<button id="mybutton">
    添加信息
</button>

<script>
    var mybutton = document.getElementById('mybutton');
    mybutton.addEventListener("click", postMessage)

    function postMessage() {
        var request = new XMLHttpRequest();

        var post = {
            title: "testPOST",
            message_kind: "test",
            content: "testcontent",
            author_id: "link"
        }

        post = JSON.stringify(post)

        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                if (request.status >= 200 && request.status < 400) {
                    console.log("successful POST")
                    if (request.responseText === "1") {
                        console.log("success create")
                    } else {
                        console.log("faild create")
                    }
                } else {
                    console.log("faild POST")
                }
            }
        }

        request.open('POST', 'http://localhost/i_wanna_tell/app/public/index.php/message/add');
        // request.open('POST', './testPOST.php');


        request.setRequestHeader("content-type", "application/json;charset=utf-8")
        request.send(post)


    }


</script>
</body>
</html>
```
