<?php
/**
 * Created by PhpStorm.
 * User: zecy
 * Date: 14-7-16
 * Time: 下午9:37
 */

// Connect to the DataBase
// Get Anime Name by Onair

$conn = odbc_connect('animedb','','');
$sql = "SELECT 动画基本信息.原名 as name, 动画基本信息.简称 as shrotname, 动画基本信息.anime_id as id, 动画基本信息.类型 as genre, 动画基本信息.时间 as oa FROM 动画基本信息 WHERE ((动画基本信息.时间) >= #2014/6/1# and (动画基本信息.时间) <= #2014/8/31#) ORDER BY 动画基本信息.时间";
$rs = odbc_exec($conn, $sql);

#==========================================================================================
#                                    组装内容
#==========================================================================================

$alltext = "";
$weekday = array("日","一","二", "三", "四", "五", "六");

while (odbc_fetch_row($rs)) {

    $animename  = odbc_result($rs, "name");
    $subname    = odbc_result($rs, "shrotname");
    $animecode  = odbc_result($rs, "id");

    # 清空内容容器
    $nrinfo     = "";
    $nrstaff    = "";
    $nrcast     = "";
    $nrstory    = "";
    $nrcomment  = "";
    $nrtime     = "";
    $nrgenre    = "";

    # 各部分查询语句

    $sqlinfo = <<<EOF
select '1' as ordinal, 'origintitle' as obj, 动画基本信息.原名 as content from 动画基本信息 where  动画基本信息.anime_id = $animecode

union

select '2' as ordinal, 'origintype' as obj, 动画基本信息.原作 as content from 动画基本信息 where  动画基本信息.anime_id = $animecode

union

select '3' as ordinal, 'onair' as obj, 动画基本信息.时间 as content from 动画基本信息 where 动画基本信息.anime_id = $animecode

union

select '4' as ordinal, 'episodes' as obj, 动画基本信息.话数 as content from 动画基本信息 where 动画基本信息.anime_id = $animecode

union

select '5' as ordinal, 'sequel' as obj, 动画基本信息.是否续作 as content from 动画基本信息 where 动画基本信息.anime_id = $animecode

union

select '6' as ordinal, 'hp' as obj, 动画基本信息.官方网站 as content from 动画基本信息 where 动画基本信息.anime_id = $animecode

order by ordinal;
EOF;

    $sqlstaff = "select [staff].staff组成 as position, [staff].staff成员 as member from [staff] where (([staff].anime_id)=" . $animecode . ") order by [Staff].staff_id"; # 获取staff信息

    $sqlcast = "select [Cast].shortname as shortname, [Cast].角色名称（原） as chara, [Cast].CV as cv ,[Cast].anime_id from [Cast] where (([Cast].anime_id)=" . $animecode . ") order by chara_id"; # 获取cast信息

    $sqlcomment = "select 动画基本信息.介绍 as comment from 动画基本信息 where((动画基本信息.anime_id)=" . $animecode . ")"; # 获取介绍内容

    $sqltime = "select top 1 onair.re_time_start, onair.re_time_end from onair where(onair.anime_id=" . $animecode . ")"; # 获取播放时间

    $sqlgenre = "select query_AnimeGenre.genre as genre from query_AnimeGenre where(query_AnimeGenre.anime_id=" . $animecode . ")"; #获取类型

    # 打开数据集
    $rsinfo     = odbc_exec($conn, $sqlinfo);
    $rstime     = odbc_exec($conn, $sqltime);
    $rsstaff    = odbc_exec($conn, $sqlstaff);
    $rscast     = odbc_exec($conn, $sqlcast);
    $rscomment  = odbc_exec($conn, $sqlcomment);
    $rsgenre    = odbc_exec($conn, $sqlgenre);

    # 基本信息格式
    while (odbc_fetch_row($rsinfo)) {

        $item       = odbc_result($rsinfo, "obj");
        $value      = odbc_result($rsinfo, "content");
        $time_start = substr(odbc_result($rstime, "re_time_start"), 11, 5);
        $time_end   = substr(odbc_result($rstime, "re_time_end"), 11, 5);

        If ($value != null) {
            If ($item == "hp") {
                $nrurl = str_ireplace("#", "", $value);
                $nrinfo = $nrinfo . "'hp':['" . $nrurl . "'],";
            }
            ElseIf ($item == "onair") {
                $nrdate = $value;
                $nrdays = $weekday[date("w", strtotime($nrdate))];
                $nrtime = $time_start . "~" . $time_end;
                $nrinfo = $nrinfo . "'onair':['" . $nrdate . " 星期" . $nrdays . " " . $nrtime . "'],";
            } Else {
                $nrinfo = $nrinfo . "'" . $item . "':['" . $value . "'],";
            }
        }
//        $rsinfo->Movenext();
    };

    while (odbc_fetch_row($rsgenre)) {
        $nrgenre = $nrgenre . odbc_result($rsgenre, "genre") . ",";
//        $rsgenre->Movenext();
    };

    $nrgenre = substr($nrgenre, 0, -1);

    $nrinfo = $nrinfo . "'genre':['" . $nrgenre . "']";


    # staff 格式
    while (odbc_fetch_row($rsstaff)) {

        $position = odbc_result($rsstaff, "position");
        $member   = odbc_result($rsstaff, "member");

//        $nrstaff = $nrstaff . "['" . $member . "', '". $member . "', '" . $isshow . "'],\n";
        $nrstaff = $nrstaff . "['" . $position . "', '". $member . "', '1'],\n";
//        $rsstaff->Movenext();
    };

    $nrstaff = substr($nrstaff, 0, -2);

    # cast 格式
    while (odbc_fetch_row($rscast)) {

        $chara = odbc_result($rscast, "chara");
        $cv    = odbc_result($rscast, "cv");

        $nrcast = $nrcast . "['" . $chara . "', '" . $cv . "', '1']\n";
//        $rscast->Movenext();
    }

    $nrcast = substr($nrcast, 0, -2);

    # 介绍格式
    $nrcomment = odbc_result($rscomment, "comment");

    $nrcomment = str_ireplace("'", "\\'", $nrcomment);
    $nrcomment = str_ireplace("<p>", "'", $nrcomment);
    $nrcomment = str_ireplace("</p>", "',\n", $nrcomment);

    $nrcomment = substr($nrcomment, 0, -2);

    # 组装全文

    $alltext = $alltext . <<<EOF
    {'name': ['$subname', '$animename'],
        'info':{
            $nrinfo
        },
        'staff':[
            $nrstaff
        ],
        'cast':[
            $nrstaff
        ],
        'comment':[
            $nrcomment
        ]
    },
EOF;
};

# 关闭读取动画名称的记录集
odbc_close($conn);

$alltext = "[" . substr($alltext, 0, -1) . "]";

echo $alltext;
?>