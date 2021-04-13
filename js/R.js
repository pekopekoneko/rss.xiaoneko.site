var fetch_col = function(mat,col)//选取某一列函数
{
    var output = [mat[0][col]];
    for(var i = 1;i < mat.length;i++)
    {
        output.push(mat[i][col]);
    }
    return(output);
}

var my_which = function(mat,col,str)//根据某一列元素的值的筛选函数
{
    var state = 0;
    findlist=fetch_col(mat,col);
    for(var i = 0;i<findlist.length;i++)
    {
        if(findlist[i]==str)
        {
            if(state==0)
            {
                var output = [mat[i]];
                state=1;
            }
            else
            {
                output.push(mat[i]);
            }
        }
    }
    return(output);
}

var my_in = function (arr,str)//寻找数组中是否含有某个函数
{
    state=false;
    for(var i=0;i<arr.length;i++)
    {
        if(arr[i]==str)
        {
            state=true;
        }
    }
    return(state);
}



var my_unique= function (arr)//R语言中的unique函数
{
    output=[arr[0]];
    for(var i=1;i<arr.length;i++)
    {
        if(!my_in(output,arr[i]))
        {
            output.push(arr[i]);
        }
    }
    return output;
}

function getQueryVariable(variable)//获取网页get传值函数
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}

function to_page(mat,page,row)//翻页数据抓取函数 使用此功能务必引入vue.js和jquery
{
    var len = mat.length;
    var first = (page-1)*row;
    var last = 0;
    if(first<0)
    {
        page = 1;
        first = page*row;
        last = page*row+row;
    }
    if(first>len)
    {
        page = (len-(len%row))/row;
        first = page*row;
        last = page*row+row;
    }else
    {
        last = page*row;
    }
    var output=mat.slice(first,last);
    
    return(output);
}

function last_page(mat,row)//获取最后一页的页码
{
    var temp = mat.length%row;
    var output = mat.length-temp;
    return(output/row+1);
}

