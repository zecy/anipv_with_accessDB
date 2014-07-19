<?php
/**
 * Created by PhpStorm.
 * User: zecy
 * Date: 14-7-16
 * Time: ����9:37
 */

// Connect to the DataBase
// Get Anime Name by Onair

$conn = odbc_connect('animedb','','');
$sql = "SELECT ����������Ϣ.ԭ�� as name, ����������Ϣ.��� as shrotname, ����������Ϣ.anime_id as id, ����������Ϣ.���� as genre, ����������Ϣ.ʱ�� as oa FROM ����������Ϣ WHERE ((����������Ϣ.ʱ��) >= #2014/6/1# and (����������Ϣ.ʱ��) <= #2014/8/31#) ORDER BY ����������Ϣ.ʱ��";
$rs = odbc_exec($conn, $sql);

#==========================================================================================
#                                    ��װ����
#==========================================================================================

$alltext = "";
$weekday = array("��","һ","��", "��", "��", "��", "��");

while (odbc_fetch_row($rs)) {

    $animename  = odbc_result($rs, "name");
    $subname    = odbc_result($rs, "shrotname");
    $animecode  = odbc_result($rs, "id");

    # �����������
    $nrinfo     = "";
    $nrstaff    = "";
    $nrcast     = "";
    $nrstory    = "";
    $nrcomment  = "";
    $nrtime     = "";
    $nrgenre    = "";

    # �����ֲ�ѯ���

    $sqlinfo = <<<EOF
select '1' as ordinal, 'origintitle' as obj, ����������Ϣ.ԭ�� as content from ����������Ϣ where  ����������Ϣ.anime_id = $animecode

union

select '2' as ordinal, 'origintype' as obj, ����������Ϣ.ԭ�� as content from ����������Ϣ where  ����������Ϣ.anime_id = $animecode

union

select '3' as ordinal, 'onair' as obj, ����������Ϣ.ʱ�� as content from ����������Ϣ where ����������Ϣ.anime_id = $animecode

union

select '4' as ordinal, 'episodes' as obj, ����������Ϣ.���� as content from ����������Ϣ where ����������Ϣ.anime_id = $animecode

union

select '5' as ordinal, 'sequel' as obj, ����������Ϣ.�Ƿ����� as content from ����������Ϣ where ����������Ϣ.anime_id = $animecode

union

select '6' as ordinal, 'hp' as obj, ����������Ϣ.�ٷ���վ as content from ����������Ϣ where ����������Ϣ.anime_id = $animecode

order by ordinal;
EOF;

    $sqlstaff = "select [staff].staff��� as position, [staff].staff��Ա as member from [staff] where (([staff].anime_id)=" . $animecode . ") order by [Staff].staff_id"; # ��ȡstaff��Ϣ

    $sqlcast = "select [Cast].shortname as shortname, [Cast].��ɫ���ƣ�ԭ�� as chara, [Cast].CV as cv ,[Cast].anime_id from [Cast] where (([Cast].anime_id)=" . $animecode . ") order by chara_id"; # ��ȡcast��Ϣ

    $sqlcomment = "select ����������Ϣ.���� as comment from ����������Ϣ where((����������Ϣ.anime_id)=" . $animecode . ")"; # ��ȡ��������

    $sqltime = "select top 1 onair.re_time_start, onair.re_time_end from onair where(onair.anime_id=" . $animecode . ")"; # ��ȡ����ʱ��

    $sqlgenre = "select query_AnimeGenre.genre as genre from query_AnimeGenre where(query_AnimeGenre.anime_id=" . $animecode . ")"; #��ȡ����

    # �����ݼ�
    $rsinfo     = odbc_exec($conn, $sqlinfo);
    $rstime     = odbc_exec($conn, $sqltime);
    $rsstaff    = odbc_exec($conn, $sqlstaff);
    $rscast     = odbc_exec($conn, $sqlcast);
    $rscomment  = odbc_exec($conn, $sqlcomment);
    $rsgenre    = odbc_exec($conn, $sqlgenre);

    # ������Ϣ��ʽ
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
                $nrinfo = $nrinfo . "'onair':['" . $nrdate . " ����" . $nrdays . " " . $nrtime . "'],";
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


    # staff ��ʽ
    while (odbc_fetch_row($rsstaff)) {

        $position = odbc_result($rsstaff, "position");
        $member   = odbc_result($rsstaff, "member");

//        $nrstaff = $nrstaff . "['" . $member . "', '". $member . "', '" . $isshow . "'],\n";
        $nrstaff = $nrstaff . "['" . $position . "', '". $member . "', '1'],\n";
//        $rsstaff->Movenext();
    };

    $nrstaff = substr($nrstaff, 0, -2);

    # cast ��ʽ
    while (odbc_fetch_row($rscast)) {

        $chara = odbc_result($rscast, "chara");
        $cv    = odbc_result($rscast, "cv");

        $nrcast = $nrcast . "['" . $chara . "', '" . $cv . "', '1']\n";
//        $rscast->Movenext();
    }

    $nrcast = substr($nrcast, 0, -2);

    # ���ܸ�ʽ
    $nrcomment = odbc_result($rscomment, "comment");

    $nrcomment = str_ireplace("'", "\\'", $nrcomment);
    $nrcomment = str_ireplace("<p>", "'", $nrcomment);
    $nrcomment = str_ireplace("</p>", "',\n", $nrcomment);

    $nrcomment = substr($nrcomment, 0, -2);

    # ��װȫ��

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

# �رն�ȡ�������Ƶļ�¼��
odbc_close($conn);

$alltext = "[" . substr($alltext, 0, -1) . "]";

echo $alltext;
?>