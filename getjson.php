<!doctype html>
<html lang="en" ng-app="AnimeIntro">
<head>
   <meta charaset="UTF-8"></meta>
    <title>Get JSON</title>
    <link rel="stylesheet" href="anime/2014jul/css/style.css" />
    <?php
       include 'dataoutput.php';
       $alltext = mb_convert_encoding($alltext,"UTF-8","GBK");
       echo "<script type=\"text/javascript\" >var animeDataBase = " . $alltext . ";</script>";
    ?>
    <!--<script type="text/javascript"> var animeDataBase = json; </script>-->
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="anime/2014jul/js/control.js"></script>
</head>
<body ng-controller="animeBox">
<header>
    <div class="headercontent">

        <h1 id="hptitle">ZC的新番手记</h1>

        <nav class="tab">

            <ul class="tab-nav clearfix">
                <li class="pages-selector">
                    显示动画数目

                    <div class="selector">

                        <span class="trangle"></span>

                        <h3>共有 {{ animeNumber }} 部动画，显示 {{ animeCurrentNumber }} 部</h3>

                        <input type="text" ng-model="pageStart" placeholder="从第N部开始显示"/> - <input type="text" ng-model="pageEnd" placeholder="到第M部结束"/>
                        <button type="button" class="btn btn-default" ng-click="animeNumberInOnePage()">确定</button>

                    </div>

                </li>

                <li class="origintype-selector">
                    原作类型

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">全部 <span>{{animeNumber}}</span></li>
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
                    是否续作

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">全部 <span>{{animeNumber}}</span></li>
                            <li ng-class="{'property-list-current' : sequel.name === currentName }"
                                ng-repeat="sequel in countedSequel" ng-click="searchProperty(sequel.name, 'sequel')">
                                {{ sequel.name }}
                                <span>{{ sequel.number }}</span>
                            </li>
                        </ul>
                    </div>

                </li>

                <li class="onair-selector">
                    播放时间

                    <div class="selector">

                        <span class="trangle"></span>

                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">全部 <span>{{animeNumber}}</span></li>
                            <li ng-show="onair" ng-class="{'property-list-current' : onair.name === currentName }" ng-repeat="onair in countedOnair | weekDays track by $index" ng-click="searchProperty(onair.name, 'onair')">
                                {{ onair.name }}
                                <span>{{ onair.number }}</span>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="genre-selector">
                    类型

                    <div class="selector">

                        <span class="trangle"></span>

                        <input type="text" ng-model="genreSearch.name" placeholder="查找类型"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">
                                全部 <span>{{ animeNumber }}</span>
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

                        <input type="text" ng-model="staffSearch.name" placeholder="查找Staff名称"/>
                        <input type="text"
                               ng-model="staffCountNum"
                               ng-change="changeCount('staff', staffCountNum)"
                               placeholder="统计下限"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">全部 <span>{{ animeNumber }}</span></li>
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

                        <input type="text" ng-model="castSearch.name" placeholder="查找Cast"/>
                        <input type="text"
                               ng-model="castCountNum"
                               ng-change="changeCount('cast', castCountNum)"
                               placeholder="统计下限"/>
                        <ul class="property-list clearfix">
                            <li ng-click="animeNumberInOnePage()">全部 <span>{{ animeNumber }}</span></li>
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

<div class="guide clearfix">

    <h1 class="guide-title">2014年夏季（7-9月）电视动画新作一览（1/2）</h1>

    <!--<div ng-repeat="name in animeName " class="animebox">-->
    <div ng-repeat="anime in animeDataBase" class="animebox">
        <a ng-href="#{{ anime.name[0] }}"><img ng-src="anime/2014jul/guide/{{ anime.name[0] }}.png" /></a>
        <h2>{{ anime.name[1] }}</h2>
    </div>

</div>
<p class="copyright">整理 / 制作 by ZC @ http://anipv.info　　</p>

<!--

    网络发布用

<div class="guide clearfix">

    <div ng-repeat="name in animeName" class="animebox">
        <a ng-href="#{{ name[0] }}"><img ng-src="http://anipv.info/blog/wp-content/themes/anipv/anime/2014apr/guide/{{ name[0] }}.jpg" /></a>
        <h2>{{ name[1] }}</h2>
    </div>

</div> -->

<!-- For WebSite :: -->

 <div ng-repeat="anime in animeDataBase" class="animedetail">
     <h2 id="{{ anime.name[0] }}" class="name">《{{ anime.name[1] }}》</h2>
     <img ng-src="anime/2014jul/images/{{ anime.name[0] }}/poster.jpg" alt=""/>

     <h3>基本信息</h3>
     <ul class="infobox">
         <li>
             <dt>原　　名</dt><dd><span>{{ anime.info.origintitle[0] }}</span></dd>
         </li>
         <li>
             <dt>原作类型</dt><dd><span>{{ anime.info.origintype[0] }}</span></dd>
         </li>
         <li>
             <dt>放送时间</dt><dd><span>{{ anime.info.onair[0] }}</span></dd>
         </li>
         <li ng-show="anime.info.episodes[0]">
             <dt>话　　数</dt><dd><span>{{ anime.info.episodes[0] }}</span></dd>
         </li>
         <li>
             <dt>作品类型</dt><dd><span>{{ anime.info.genre[0] }}</span></dd>
         </li>
         <li>
             <dt>官方网站</dt><dd><span><a ng-href="{{ anime.info.hp[0] }}">{{ anime.info.hp[0] }}</a></span></dd>
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

     <h3>简介</h3>
     <div class="dialog">
         <p ng-repeat="comment in animeDataBase[$index].comment">{{ comment }}</p>
     </div>

 </div>

<!-- For BBCode ::

<pre ng-repeat="anime in animeDataBase" class="animedetail">

[size=5]《{{ anime.name[1] }}》[/size]

[img]http://anipv.info/blog/wp-content/themes/anipv/anime/2014jul/{{ anime.name[0] }}/poster.jpg[/img]

[size=3][color=blue]▌[/color]基本信息[/size]

　　[b]原　　名：[/b]{{ anime.info.origintitle[0] }}
　　[b]原作类型：[/b]{{ anime.info.origintype[0] }}
　　[b]放送时间：[/b]{{ anime.info.onair[0] }}<p ng-show="anime.info.episodes[0]">　　[b]话　　数：[/b]{{ anime.info.episodes[0] }}<br /></p><p>　　[b]官方网站：[/b]{{ anime.info.hp[0] }}</p>
[size=3][color=blue]▌[/color]Staff[/size]

<p ng-repeat="staff in animeDataBase[$index].staff | hideItem">　　[b]{{ staff[0] }}：[/b]{{ staff[1] }}</p>
[size=3][color=blue]▌[/color]Cast[/size]

<p ng-repeat="cast in animeDataBase[$index].cast | hideItem">　　[b]{{ cast[0] }}：[/b]{{ cast[1] }}</p>
[size=3][color=blue]▌[/color]简介[/size]

<p ng-repeat="comment in animeDataBase[$index].comment">　　{{ comment }}</p>
</pre>
-->

<!-- For Zhihu ::

<pre ng-repeat="anime in animeDataBase" class="animedetail">


《{{ anime.name[1] }}》

图

【基本信息】

　　原　　名：{{ anime.info.origintitle[0] }}
　　原作类型：{{ anime.info.origintype[0] }}
　　放送时间：{{ anime.info.onair[0] }}
　　<span ng-show="anime.info.episodes[0]">话　　数：{{ anime.info.episodes[0] }}</span>
　　官方网站：{{ anime.info.hp[0] }}

【Staff】

<span ng-repeat="staff in animeDataBase[$index].staff | hideItem">　　{{ staff[0] }}：{{ staff[1] }}<br/></span>
【Cast】

<span ng-repeat="cast in animeDataBase[$index].cast | hideItem">　　{{ cast[0] }}：{{ cast[1] }}<br/></span>
【简介】

<span ng-repeat="comment in animeDataBase[$index].comment">　　{{ comment }}<br/></span>
</pre>

-->

<div class="scrolltop">
    <a href="#top">返回顶部</a>
</div>

</div>
</body>
</html>
