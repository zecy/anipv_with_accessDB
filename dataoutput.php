<?php
/**
 * Created by PhpStorm.
 * User: zecy
 * Date: 14-7-16
 * Time: 下午9:37
 */

//Connect to the DataBase

$conn = odbc_connect('animedb','','');
$sql = "SELECT 动画基本信息.原名 as name, 动画基本信息.简称 as shrotname, 动画基本信息.anime_id as id, 动画基本信息.类型 as genre, 动画基本信息.时间 as oa FROM 动画基本信息 WHERE ((动画基本信息.时间) >= #2014/6/1# and (动画基本信息.时间) <= #2014/8/1#)";
$rs = odbc_exec($conn, $sql);

/*

#==========================================================================================
#                             根据时间提取动画名称
#==========================================================================================

$sqlname = "SELECT 动画基本信息.原名 as name, 动画基本信息.简称 as short, 动画基本信息.anime_id as id, 动画基本信息.类型 as geren, 动画基本信息.时间 as time FROM 动画基本信息 WHERE"

$sqlname = sqlname & "((动画基本信息.时间)<=#" & todate & "# and (动画基本信息.时间)>=#" & frdate & "#)"


'==========================================================================================
'                                    组装内容
'==========================================================================================

sqlname = sqlname + " ORDER BY 动画基本信息.时间"

$alltext = ""

$rsname = odbc_exec($conn, $sqlname);

Do While Not rsname.EOF
$animename  = odbc_result($rsname, "name");
$subname    = odbc_result($rsname, "shrot");
$animecode  = odbc_result($rsname, "id");

    # 清空内容容器
    $nrinfo = ""
    $nrsec = ""
    $nrurl = ""
    $nroriginal = ""
    $nrweekdays = ""
    $orityle = ""

    # 各部分查询语句
    $sqlinfo    = "select 动画基本信息.中文 as name , 动画基本信息.时间 as onair, 动画基本信息.原作 as original, 动画基本信息.类型 as genre, 动画基本信息.官方网站 as hpurl from 动画基本信息 where(动画基本信息.anime_id=" & animecode & ")" '获取动画名称
    $sqltime    = "select top 1 onair.re_time_start, onair.re_time_end from onair where(onair.anime_id=" & animecode & ")"

    $rsinfo     = odbc_exec($conn, $sqlinfo);
    $rstime     = odbc_exec($conn, $sqltime);


    #原作
'    Select Case odbc_result($rsinfo, "original")
'
'        Case "GALGAME"
'            oritype = "game"
'
'        Case "游戏"
'            oritype = "game"
'
'        Case "漫画"
'            oritype = "comic"
'
'        Case "TV原创"
'            oritype = "original"
'
'        Case "轻小说"
'            oritype = "lightnovel"
'
'        Case Else
'            oritype = "other"
'    End Select

    #星期格式化
    nrdate = Format(rsinfo("onair"), "mm/dd")
    nrtime_start = Format(rstime("re_time_start"), "hh:nn")
    nrtime_end = Format(rstime("re_time_end"), "hh:nn")
    nrweekdays = Replace(WeekdayName(Weekday(rsinfo("onair"))), "星期", "每周")

    # 组装全文

    alltext = alltext & Chr(13) & Chr(10) & _
    "<!--" & nrdate & " " & WeekdayName(Weekday(rsinfo("onair"))) & " " & nrtime_start & " " & rsinfo("name") & "{{{1-->" & Chr(13) & Chr(10) & _
    "<div id=" & Chr(34) & subname & Chr(34) & " class=" & Chr(34) & "animebox" & Chr(34) & ">" & Chr(13) & Chr(10) & _
    "    <img src=" & Chr(34) & subname & ".png" & Chr(34) & " />" & Chr(13) & Chr(10) & _
    "    <h2>" & rsinfo("name") & "</h2>" & Chr(13) & Chr(10) & _
    "    <p>" & nrdate & "　" & nrweekdays & "&nbsp;&nbsp;" & nrtime_start & "-" & nrtime_end & "</p>" & Chr(13) & Chr(10) & _
    "</div> <!--}}}-->" & Chr(13) & Chr(10) & Chr(13) & Chr(10)

    outputcode = outputcode & animecode & Chr(13) & Chr(10)
    i = i + 1 ' 计算总共输出了多少部动画资料，防止遗漏
    guidecount = guidecount + 1

    ' 关闭记录集
    rssec.Close
    rsinfo.Close
    rstime.Close

    Set rssec = Nothing
    Set rsinfo = Nothing
    Set rstime = Nothing

rsname.MoveNext
Loop

' 输出结果

Me.artoutput.Value = alltext
Me.outputcode.Value = outputcode
Me.outputsta.Value = i & " 部"

' 关闭读取动画名称的记录集
rsname.Close
Set rsname = Nothing

*/
?>