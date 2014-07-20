<?php include 'dataoutput.php';?>
<!doctype html>
<html lang="en" ng-app="AnimeIntro">
<head>
    <title>Get JSON</title>
    <link rel="stylesheet" href="anime/2014jul/css/style.css" />
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript"> var animeDataBase = json; </script>
    <script type="text/javascript" src="anime/2014jul/js/control.js"></script>
</head>
<body ng-controller="animeBox">
<header>
    <div class="headercontent">

        <h1 id="hptitle">ZC���·��ּ�</h1>

        <nav class="tab">

            <ul class="tab-nav clearfix">
                <li class="pages-selector">
                    ��ʾ������Ŀ

                    <div class="selector">

                        <span class="trangle"></span>

                        <h3>���� {{ animeNumber }} ����������ʾ {{ animeCurrentNumber }} ��</h3>

                        <input type="text" ng-model="pageStart" placeholder="�ӵ�N����ʼ��ʾ"/> - <input type="text" ng-model="pageEnd" placeholder="����M������"/>
                        <button type="button" class="btn btn-default" ng-click="animeNumberInOnePage()">ȷ��</button>

                    </div>

                </li>

                <li class="origintype-selector">
                    ԭ������

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">ȫ�� <span>{{animeNumber}}</span></li>
                            <li ng-class="{'property-list-current' : origintype.name === currentName }"
                                ng-repeat="origintype in countedOrigintype"
                                ng-click="searchProperty(origintype.name, 'origintype')">
                                {{ origintype.name }}
                                <span>{{ origintype.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sequel-selector">
                    �Ƿ�����

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">ȫ�� <span>{{animeNumber}}</span></li>
                            <li ng-class="{'property-list-current' : sequel.name === currentName }"
                                ng-repeat="sequel in countedSequel" ng-click="searchProperty(sequel.name, 'sequel')">
                                {{ sequel.name }}
                                <span>{{ sequel.number }}</span>
                            </li>
                        </ul>
                    </div>

                </li>

                <li class="onair-selector">
                    ����ʱ��

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">ȫ�� <span>{{animeNumber}}</span></li>
                            <li ng-show="onair" ng-class="{'property-list-current' : onair.name === currentName }" ng-repeat="onair in countedOnair | weekDays track by $index" ng-click="searchProperty(onair.name, 'onair')">
                                {{ onair.name }}
                                <span>{{ onair.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="genre-selector">
                    ����

                    <div class="selector">

                        <span class="trangle"></span>

                        <input type="text" ng-model="genreSearch.name" placeholder="��������"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">
                                ȫ�� <span>{{ animeNumber }}</span>
                            </li>
                            <li ng-class="{'property-list-current' : genre.name === currentName }"
                                ng-repeat="genre in countedGenre | filter: genreSearch"
                                ng-click="searchProperty(genre.name, 'genre')">
                                {{ genre.name }} <span>{{ genre.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="staff-selector">

                    Staff

                    <div class="selector">

                        <span class="trangle"></span>

                        <input type="text" ng-model="staffSearch.name" placeholder="����Staff����"/>
                        <input type="text"
                               ng-model="staffCountNum"
                               ng-change="changeCount('staff', staffCountNum)"
                               placeholder="ͳ������"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">ȫ�� <span>{{ animeNumber }}</span></li>
                            <li ng-class="{'property-list-current' : staff.name === currentName }"
                                ng-repeat="staff in countedStaff | filter:staffSearch"
                                ng-click="searchProperty(staff.name, 'staff')">
                                {{ staff.name }}
                                <span>{{ staff.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="cast-selector">
                    Cast

                    <div class="selector">

                        <span class="trangle"></span>

                        <input type="text" ng-model="castSearch.name" placeholder="����Cast"/>
                        <input type="text"
                               ng-model="castCountNum"
                               ng-change="changeCount('cast', castCountNum)"
                               placeholder="ͳ������"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">ȫ�� <span>{{ animeNumber }}</span></li>
                            <li ng-class="{'property-list-current' : cast.name === currentName }"
                                ng-repeat="cast in countedCast | filter: castSearch"
                                ng-click="searchProperty(cast.name, 'cast')">
                                {{ cast.name }}
                                <span>{{ cast.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </nav>

    </div>
</header>

<div class="wrap">

<div class="intro" >

    <p>��Һã�����ZC�����ǹ�����ÿ�����·����ܡ���Ϊ����̫æ������Ū�귢������ʱ���·��������Ѿ�������OTL</p>
    <p>������Ȼ����4��Ⱥħ���裬����д����Ҳû��ʲô���顣������Ȥ����Ʒ�����в��٣�����Ϊ���������Ļ��Ǳ�4���п�ͷ��һ�����ȡ�</p>
    <p>�����·���45������һ�������ֽ�Ŀ�м䲥�ŵĶ�ƪ�������ˤ��פ��ˤ��ޣ�è��è��Ħ����û���㣬����Ӧ����46����</p>
    <p>46���У�������29����������17�����������桶����Ůսʿ������ȫ���ƣ���ץ��һ�塷��16��ǰ����Ƭ�ڶ�����</p>
    <p>ԭ����Դ���棬ԭ�������������£�ȫ������5�����������ǻ�����Ƭ������������־���͡�ALDNOAH ZERO����P.A.Works�ķ羰У԰NTR������֮�á����ɱ���һ�ɡ���Ұ���ӵı�����ġ��ֲ������������С������ɣ�����硷�Ŷӵġ���ϰŮ���ǡ�����ԭ����Ʒ�����������С���֥��2����Space Dandy 2���͡�Re�����������ȽϿӵ��ǡ�Psycho-Pass�������¼����棬�������������Ϊ10�µڶ�����֮��ĵ�Ӱ������ϰԤ�ȵģ��������¼����ܱ��ز��г��⡣</p>
    <p>��С˵�ı�����8�������ˡ����������ر�ƪ˵5�²������ϵ�8�µ����⣬�������������������ȵ���Ʒ�����������Ǳ�����Ȩ�򲹡�SAO2���;�����ĸ�Ƭ��Free�ڶ�������ʣ�µ�5�������������ֱ��ǡ�����ս���������������ҽ�������ƺ����������ߡ��͡�����ʹ�Ľ��衷��</p>
    <p>����һ����һ��С˵�ı�ġ���������롷����ʵҲ�����Ǹı࣬��Ϊ������������ԭ����Ϊ�������´����ġ�</p>
    <p>��Ϸ�ı��5������ĻĩRock����DRAMAtical Murder������������Pripara���ǰ벿��������ս��Basara Judge End���͡�Ů������¼4 �ƽ�桷����������GALGAME�ı����Ѿ��þ�û�������ء�</p>
    <p>�����ı���Ȼ��������������29����</p>
    <p>ʣ���2����1��������Ƭ����˹��ġ�����ܶ�Ա֮����ҹ������ֻ��һ�����ر�ƪ����������һ����Ϊԭ����ɫ�����Ķ�����������˿������</p>
    <p>������ˡ�</p>
    <p>��Ȼд���ĵ�ʱ���·������Ĳ���ˣ�Ҳ����һ���֣���дһ�¾�Υ�ļ����Թ��ο��ɣ��в����ǻ�û���ģ���д������ˡ���ϸ����Ʒ���ܻ��뿴���ġ�</p>
    <p></p>
    <p>�����ǻ����������ض����ˣ�Ӧ�ö�֪����</p>
    <p>������ŮսʿCrystal����������Ʒ���ƣ��������⣬���������ۺû������ܻῴһ������Ʒ������������ô���ͼ��ʼ����ˡ�</p>
    <p>��SAO2����û̫���˵�ģ���Ȩ������</p>
    <p>��Free �ڶ�������������ĸ�Ƭ��</p>
    <p>��ALDNOAH ZERO������������������Ԩ����ԭ�������˶�����ƫ��ʵϵ�Ŀƻ�ս����ġ�����ˮ׼��˦��ͬ����Ʒ����������־���öࡣ�����ӵ�һ�����̵��������������������ͦ�ߵġ���Ȼ�������񡶸�������һ�������������Һ�����ʵϵ��ѽ����</p>
    <p></p>
    <p>Ȼ���Ǵ�У԰�������������</p>
    <p>������֮�á���P.A.Works��ԭ�������������ϵ�ǽ�һ���ң�P.A�Ѿ���������辫����Ⱦ�˰ɡ�</p>
    <p>����˸���ഺ����Production I.G������ԭ������Ů������û�С���������㡷��ô�������Ҷ�θ���𺦱Ƚϴ�</p>
    <p></p>
    <p>���+ս��+У԰������ġ�</p>
    <p>����ҵħŮ���ȡ���ԭ���ǡ����լ�С����߶ɱߺ��������������ߴ�ͳ������·�ߣ����������ɾ����￴������˳���ˣ�</p>
    <p>����ƺ����������ߡ���ԭ������С˵������ͦ΢��ģ��е����ߵ���������Կ����ĵĽ��ܡ���Ȼ�����Ǵ����ģ�����ǿ�ͷ�������ӵ�һ�������Ļ���������ͦ���֣����о�ͦһ��ģ�ȴ���㡣���ľ�����û���ˣ���Ȼ�籾��ԭ���߼��޾����ˡ���</p>
    <p>������ʹ�Ľ��衷��MF�Ŀ�J 5����������Ʒ�ĵ������Ĳ�����5����ƷĿǰ������������ǡ�No Game No Life�������ǿ̵�����ʿ���������̫��û���̡��ⲿ�͡��ǿ̡���ȫ��ͬ����Ʒ��֮�����п�ͷ����Ϊ����Staff�ǡ�DxD����ס�</p>
    <p></p>
    <p>������ս����ġ�</p>
    <p>����������־������������ĵ�һ�������ͳɱ�������Ӧ�ò����ھ��Ѳ��������������������ʲô�����ˡ�͵���ĺۼ�̫���ԣ�������������ֱ�ӿ��˾籾�����ڻ��־���ʱ�����������ݣ�Ҫ�����ǻ��п�û����ɣ����Կ������پ�ͷʱ��������ĳ������ұ�����ͷ�ܶࡣ������·���������޷��²ۣ���Ȼ�ǹ����������ŵģ������Ǳ��͵���������ϲ��Ҫ���޴ӵ�֪�������ڹ����Ͽ�������ʲô���ʵĵط�������������ίԱ��û����Ǯ�����������˽�ģ����̫��Ǯ�޷���֪����ˮ׼�ȡ��ֻص��������ա�����ˡ�������������ίԱ���кö�ҹ�˾����ҵ������Ӱ�ģ�������Ӷ����ò���ֻ�Ƕ�����Ӱ������Ƭ����Ӱ��������ɣ���Ȼ���ڱ���Ҳû�г���Ӱ����Ϣ���������󹫲���Ҳ��Ҫ������֡�</p>
    <p>��ն�����֮ͫ�����㵱�ͷ���һ����֮��֪������ʣ��������һ�����岻�����·���Ӧ�ò�����ʲô���⣬��ϧ�߳������ݳ��������Բ��㣬�����¶������Ŀ��ʱ��ȱ����������ú�һ�������˷��ˣ��е�Сʧ����</p>
    <p>������ʳʬ��������ս������������˹�ϵ��˼�����Ǳ��������㣬����һ������ʵ����ԡ������ӵ�һ����������ľ�Ķ�ҡ���ֻ���ȱ��һ�־����Եĳ������</p>
    <p>�����������߲п�չ��·�ߵģ������������ڴ��ģ��������ն����ڱ�������δ�����������ء�</p>
    <p>������ESP������һ���Ͱѽ���ó�������һ�µ��𣬸о����˼����ľ����������ˡ���ʳ��-��-���ĺۼ�̫�أ���֪������Ƭ����Ҫ����Staff�������Ĳ��㻹�����߶��С�ģ��һ�¡�ʳ��-��-���ĵ�һ������Ȫ�����������ʹ�һ�£����С�ʳ��-��-����һ���ı㵱С�ӣ����û����������˫��������ʵ�ǰ��Ż�Ȫ�ĵ���������ġ������ǵ�һ��û�еǳ���һ������ʵ������ʵ��Ů���ǰ������ĸо��������Ǹ��������ܻ��Ǳ����߾��ǿ����ˣ�</p>
    <p>���ҽ���������֮�е�����·����Ʒ������˵������������˵�������������ˣ�ûʲô���㡭��</p>
    <p>������ս��������·����������⣬�������ݺ��ݳ�������ͨ��ȱ�����㣬û̫����ڸС�</p>
    <p></p>
    <p>Ů����BL�ࡣ</p>
    <p>��Love Stage����ԭ������Ů����������ϸ�»����������ǻ���Ů����˵���еġ��������ε����а��������޷�ֱ�ӡ�</p>
    <p>��DRAMAtical Murder����ԭ����18��BL GAME�����������ǲ����޷�ֱ�ӡ�</p>
    <p></p>
    <p>��ϵ�ճ�ϵ��</p>
    <p>��������Ů���������Ƶ���Ʒ����Ȼ���辡����ԭ���������Ǹ�����ƺ�����ô�ʺ϶���������������ô˳�ۣ��ر����Ǹ����ε��۾�������Q���ֲ��Ǹ�˼·����ɫ����Ч���¹����ˣ����濴��������Ư����</p>
    <p>��������Ϸ�硷��̫�����嵼�ݣ����ı�֤����ʱ��̽�G�����ճ�ϵ�ĵ����ˡ�</p>
    <p>����������ԭ��û̫����˼������Ҳ��һ�������ָ����Ȳ������ĸо������ȡ�ɱ�������������ˣ����Ǻ��������ǵ���̫���˰ɡ���������ſ����á��ȵ����ĸо��������������Ȥ��</p>
    <p>���㼧�ճ���������Ů����Ȼ��˵���еġ�</p>
    <p></p>
    <p>��Ц�࣬����Ͳ��ض�˵�ˣ�����������֪���Ķ�֪����</p>
    <p>���ߴ�ɣ�����ڲ�ȫ�޵�����ͷ��Ц�����ܿ�ϧֻ�Ƕ�ƪ��</p>
    <p>���¿���ŮҰ�������������ԭ�����൱��Ȥ���ᶯ��ǧ���������ɰ������Ǹ�ЦЧ���о���ԭ�����ǲ��˵㣬�����ǿ���ԭ����ɵĴ����</p>
    <p></p>
    <p>ż���ࡣ</p>
    <p>��Pripara�����̳С��������ɡ�ϵ����ϵ�С������Ϻ͡��������ɡ�û����</p>
    <p>����������롷��ԭ����С˵��������ԭ��������ִ�ʵ��¹��¡���Ȼԭ��������Ů�������Ʒ�����ǿ������������ֻ��ĸо�����</p>
    <p>����ͨŮ������Ҫ������ż�񡷣���ʵ�������ճ�ϵ��ϲ�硣ԭ�����ĸ������������кú�д�������Ĺ��£����ֵ�ó��ޡ�����̫���ˣ�����Ҳ�û������Ҳ�ã�ȱ���߳���Ҫ˵����ϵ�Ļ�����Ҳû����λ������ż�������о��ܲ�����������ʲô����׷����Ʒ��</p>
    <p></p>
    <p>�м��������������Ʒ������</p>
    <p>���ų�Э����������ʿ����̨����ת�����������֮����ȫCG��������Խ��ģ����»�������˼����������Ч��CG�Ѿ����úܲ����ˣ���ϧ3D���ﲻ����΢����ȻЧ�����ǲ��С�</p>
    <p>����ϰŮ���ǡ����ձ����Ӷ���ʷ�ϵ�һ����ֱ����������</p>
    <p></p>
    <p>���������Ʒ��</p>
    <p>���ֲ���������������ĵ�ԭ����������һ���ͷ�̹�Ȩ���ؼ�ը�˸���¥�ˣ�����ò����ɽ�Ƭ�ɡ���</p>
    <p>��Ԫ�����С����о���������������յķ�ΧӪ��ò�����Ȼ���С�����ʽ���ĳɹ������������ء������������ڴ�д�鷨�Ĳ��ֿ����б�������ǿ�ı������ģ���ϧ��û����ǰһ���ĸо���</p>
    <p></p>
    <p>����������</p>
    <p>��Space Dandy2����2�ڷָ�ĺ�룬��Ȼ��ĺ�High��</p>
    <p>��Re����������2�ڷָ�ĺ�룬��һ�����˸�������������϶����ٵ������ˡ�</p>
    <p>��Ů������¼4 �ƽ�桷�����������Ϻ͡�Ů������¼4��ûʲô���𣬲�������ȫ�������ˣ�ս������Ū�ñ�֮ǰ�����˺ܶ࣬���Ҽ�����ˡ��ص��Ȼ������˰ɡ���</p>
    <p>��ħ����Ů������2wei����С�ڵǳ��������ٰ���</p>
    <p>����֥��2�������ܺ���֮��ĵڶ������������˼����ֲ���Ӱ�������ʹ��������ڴ����������ݡ�������һ������������ô�ֲ��ء���</p>
    <p>����ɽ���� �ڶ���������������Ϊ15�����������ˣ�������е������������30����һ�����أ�</p>
    <p>�����в�2�����������ϵĵڶ�������Ȼ���񾭲�ʽ����ͷ��Ц��</p>
    <p>����Strange Plus����ͬ��û�뵽���еڶ�����Ҳ���񾭲�ʽ����ͷ��Ц�������������ݻ����ˣ�ˮ׼�ܲ��ܱ����ء�</p>

</div>

<div class="guide clearfix">

    <h1 class="guide-title">2014���ļ���7-9�£����Ӷ�������һ����1/2��</h1>

    <!--<div ng-repeat="name in animeName " class="animebox">-->
    <div ng-repeat="anime in animeDataBase" class="animebox">
        <a ng-href="#{{ anime.name[0] }}"><img ng-src="anime/2014jul/guide/{{ anime.name[0] }}.png" /></a>
        <h2>{{ anime.name[1] }}</h2>
    </div>

</div>
<p class="copyright">���� / ���� by ZC @ http://anipv.info����</p>

<!--

    ���緢����

<div class="guide clearfix">

    <div ng-repeat="name in animeName" class="animebox">
        <a ng-href="#{{ name[0] }}"><img ng-src="http://anipv.info/blog/wp-content/themes/anipv/anime/2014apr/guide/{{ name[0] }}.jpg" /></a>
        <h2>{{ name[1] }}</h2>
    </div>

</div> -->

<!-- For WebSite :: -->

 <div ng-repeat="anime in animeDataBase" class="animedetail">
     <h2 id="{{ anime.name[0] }}" class="name">��{{ anime.name[1] }}��</h2>
     <img ng-src="anime/2014jul/images/{{ anime.name[0] }}/poster.jpg" alt=""/>

     <h3>������Ϣ</h3>
     <ul class="infobox">
         <li>
             <dt>ԭ������</dt><dd><span>{{ anime.info.origintitle[0] }}</span></dd>
         </li>
         <li>
             <dt>ԭ������</dt><dd><span>{{ anime.info.origintype[0] }}</span></dd>
         </li>
         <li>
             <dt>����ʱ��</dt><dd><span>{{ anime.info.onair[0] }}</span></dd>
         </li>
         <li ng-show="anime.info.episodes[0]">
             <dt>��������</dt><dd><span>{{ anime.info.episodes[0] }}</span></dd>
         </li>
         <li>
             <dt>��Ʒ����</dt><dd><span>{{ anime.info.genre[0] }}</span></dd>
         </li>
         <li>
             <dt>�ٷ���վ</dt><dd><span><a ng-href="{{ anime.info.hp[0] }}">{{ anime.info.hp[0] }}</a></span></dd>
         </li>
     </ul>

     <h3>Staff</h3>
     <ul class="infobox">
         <li ng-repeat="staff in animeDataBase[$index].staff | hideItem">
             <dt>{{ staff[0] }}</dt>
             <dd><span>{{ staff[1] }}</span></dd>
         </li>
     </ul>

     <h3>Cast</h3>
     <ul class="infobox">
         <li ng-repeat="cast in animeDataBase[$index].cast | hideItem">
             <dt>{{ cast[0] }}</dt>
             <dd><span>{{ cast[1] }}</span></dd>
         </li>
     </ul>

     <h3>���</h3>
     <div class="dialog">
         <p ng-repeat="comment in animeDataBase[$index].comment">{{ comment }}</p>
     </div>

 </div>

<!-- For BBCode ::

<pre ng-repeat="anime in animeDataBase" class="animedetail">

[size=5]��{{ anime.name[1] }}��[/size]

[img]http://anipv.info/blog/wp-content/themes/anipv/anime/2014jul/{{ anime.name[0] }}/poster.jpg[/img]

[size=3][color=blue]��[/color]������Ϣ[/size]

����[b]ԭ��������[/b]{{ anime.info.origintitle[0] }}
����[b]ԭ�����ͣ�[/b]{{ anime.info.origintype[0] }}
����[b]����ʱ�䣺[/b]{{ anime.info.onair[0] }}<p ng-show="anime.info.episodes[0]">����[b]����������[/b]{{ anime.info.episodes[0] }}<br /></p><p>����[b]�ٷ���վ��[/b]{{ anime.info.hp[0] }}</p>
[size=3][color=blue]��[/color]Staff[/size]

<p ng-repeat="staff in animeDataBase[$index].staff | hideItem">����[b]{{ staff[0] }}��[/b]{{ staff[1] }}</p>
[size=3][color=blue]��[/color]Cast[/size]

<p ng-repeat="cast in animeDataBase[$index].cast | hideItem">����[b]{{ cast[0] }}��[/b]{{ cast[1] }}</p>
[size=3][color=blue]��[/color]���[/size]

<p ng-repeat="comment in animeDataBase[$index].comment">����{{ comment }}</p>
</pre>
-->

<!-- For Zhihu ::

<pre ng-repeat="anime in animeDataBase" class="animedetail">


��{{ anime.name[1] }}��

ͼ

��������Ϣ��

����ԭ��������{{ anime.info.origintitle[0] }}
����ԭ�����ͣ�{{ anime.info.origintype[0] }}
��������ʱ�䣺{{ anime.info.onair[0] }}
����<span ng-show="anime.info.episodes[0]">����������{{ anime.info.episodes[0] }}</span>
�����ٷ���վ��{{ anime.info.hp[0] }}

��Staff��

<span ng-repeat="staff in animeDataBase[$index].staff | hideItem">����{{ staff[0] }}��{{ staff[1] }}<br/></span>
��Cast��

<span ng-repeat="cast in animeDataBase[$index].cast | hideItem">����{{ cast[0] }}��{{ cast[1] }}<br/></span>
����顿

<span ng-repeat="comment in animeDataBase[$index].comment">����{{ comment }}<br/></span>
</pre>

-->

<div class="scrolltop">
    <a href="#top">���ض���</a>
</div>

</div>
</body>
</html>
