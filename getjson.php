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

<div class="intro" >

    <p>大家好，我是ZC。还是惯例的每季度新番介绍。因为工作太忙，本季弄完发出来的时候新番基本都已经开播了OTL</p>
    <p>本季虽然不像4月群魔乱舞，介绍写起来也没有什么激情。不过有趣的作品还是有不少，我作为观众来看的话是比4月有看头的一个季度。</p>
    <p>本季新番共45部，有一部在音乐节目中间播放的短篇动画《にゃんぷくにゃるま（猫福猫达摩）》没有算，算上应该是46部。</p>
    <p>46部中，新作有29部，续作有17部。续作里面《美少女战士》是完全重制，《抓狂一族》是16年前的老片第二季。</p>
    <p>原作来源方面，原创动画继续回温，全新作有5部。有两部是机器人片：《白银的意志》和《ALDNOAH ZERO》，P.A.Works的风景校园NTR《玻璃之旅》，渡边信一郎×菅野洋子的暴恐题材《恐怖余音》，还有《摸索吧！部活剧》团队的《见习女主角》。而原创作品的续作方面有《暗芝居2》《Space Dandy 2》和《Re：滨虎》。比较坑的是《Psycho-Pass》的重新剪辑版，这个纯粹是用来为10月第二季和之后的电影版做复习预热的，不过重新剪辑总比重播有诚意。</p>
    <p>轻小说改编作有8部，除了《花物语》这个特别篇说5月播现在拖到8月的以外，其他几部都是正常长度的作品。续作方面是本季霸权候补《SAO2》和京阿尼的腐片《Free第二季》。剩下的5部都是新作，分别是《铁道战争》《人生》《桃剑》《三坪房间的侵略者》和《精灵使的剑舞》。</p>
    <p>还有一部是一般小说改编的《少年好莱坞》。其实也不算是改编，因为动画的内容是原作者为动画重新创作的。</p>
    <p>游戏改编的5部。《幕末Rock》《DRAMAtical Murder》是新作，《Pripara》是半部新作，《战国Basara Judge End》和《女神异闻录4 黄金版》则是续作。GALGAME改编作已经好久没看到了呢。</p>
    <p>漫画改编依然是主流，本季共29部。</p>
    <p>剩余的2部，1部是译制片，迪斯尼的《玩具总动员之惊魂夜》，是只有一集的特别篇动画，另外一个是为原创角色制作的动画《弗朗西丝卡》。</p>
    <p>大致如此。</p>
    <p>既然写本文的时候新番都出的差不多了，也看了一部分，就写一下久违的简评以供参考吧，有部分是还没出的，就写点简介好了。详细的作品介绍还请看正文。</p>
    <p></p>
    <p>首先是话题作，不必多提了，应该都知道。</p>
    <p>《美少女战士Crystal》：经典作品重制，名声在外，属于是无论好坏反正总会看一集的作品。至于制作怎么样就见仁见智了。</p>
    <p>《SAO2》：没太多好说的，霸权候补作。</p>
    <p>《Free 第二季》：京阿尼的腐片。</p>
    <p>《ALDNOAH ZERO》：あおきえい×虚渊玄的原创机器人动画，偏真实系的科幻战争题材。制作水准上甩开同类作品《白银的意志》好多。不过从第一话的铺垫来看后面神棍化可能性挺高的。虽然不至于像《革命机》一样乱来，但是我好像看真实系的呀……</p>
    <p></p>
    <p>然后是纯校园恋爱类的两部。</p>
    <p>《玻璃之旅》：P.A.Works的原创新作，人物关系那叫一个乱，P.A已经被冈田大妈精神污染了吧。</p>
    <p>《闪烁的青春》：Production I.G制作，原作是少女漫画，没有《好想告诉你》那么闪，而且对胃的损害比较大。</p>
    <p></p>
    <p>奇幻+战斗+校园恋爱类的。</p>
    <p>《修业魔女璐璐萌》：原作是《飙速宅男》作者渡边航创作的漫画，走传统的王道路线，动画线条干净人物看起来更顺眼了！</p>
    <p>《三坪房间的侵略者》：原作是轻小说，评价挺微妙的，有点两边倒，具体可以看正文的介绍。虽然导演是大沼心，这就是看头。不过从第一话来看的话：热闹是挺热闹，但感觉挺一般的，却亮点。而改剧情是没跑了，虽然剧本有原作者监修就是了……</p>
    <p>《精灵使的剑舞》：MF文库J 5部动画化作品的倒数第四部。这5部作品目前最令人满意的是《No Game No Life》，《星刻的龙骑士》人设风格变太大没法忍。这部和《星刻》完全是同类作品，之所以有看头，因为制作Staff是《DxD》班底。</p>
    <p></p>
    <p>动作、战斗类的。</p>
    <p>《白银的意志》：难以想象的第一话就来低成本制作，应该不至于经费不够，怀疑是制作管理出什么问题了。偷工的痕迹太明显，节奏拖沓，不是直接砍了剧本就是在画分镜的时候削减了内容，要不就是还有卡没有完成，可以看到不少镜头时间无意义的长，而且背景镜头很多。故事套路化到让人无法吐槽，显然是故意这样安排的，至于是编剧偷懒，还是上层的要求无从得知。反正在故事上看不出有什么出彩的地方。至于是制作委员会没给够钱还是做机器人建模花了太多钱无法得知。这水准比《轮回的拉格朗日》差多了。不过，本作的委员会有好多家公司主主业是做电影的，这个电视动画该不会只是动画电影的宣传片，电影才是真身吧？虽然现在本作也没有出电影的消息，但是往后公布了也不要觉得奇怪。</p>
    <p>《斩！赤红之瞳》：便当猛发，一季度之后不知道会死剩几个。第一话整体不错，故事方面应该不会有什么问题，可惜高潮部分演出力度明显不足，艾丽娅露出真面目的时候缺乏冲击力，好好一个场景浪费了，有点小失望。</p>
    <p>《东京食尸鬼》：比起战斗，对人与非人关系的思考才是本作的亮点，带有一定的现实讽刺性。不过从第一话来看，金木的动摇表现还是缺乏一种决定性的冲击力。</p>
    <p>这两部都是走残酷展开路线的，本来都有所期待的，但是最终都是在表现力上未能令人满意呢。</p>
    <p>《东京ESP》：第一话就把结局拿出来了玩一下倒叙，感觉砸了几话的经费在里面了。《食灵-零-》的痕迹太重，不知道是制片方的要求还是Staff自身信心不足还是两者都有。模仿一下《食灵-零-》的第一话，黄泉神乐拉出来客串一下，还有《食灵-零-》第一话的便当小队（这次没有死），拿双刀的美奈实是按着黄泉的调调来塑造的。男主角第一话没有登场，一整个其实是美奈实和女主角爱恨情仇的感觉。往后是跟着漫画跑还是编剧大暴走就是看点了！</p>
    <p>《桃剑》：意料之中的王道路线作品。不过说好听就王道，说难听就是老套了，没什么亮点……</p>
    <p>《铁道战争》：铁路题材是有新意，但是内容和演出都很普通，缺乏亮点，没太多存在感。</p>
    <p></p>
    <p>女性向、BL类。</p>
    <p>《Love Stage》：原作是少女漫画，画面细致华丽，根本是画个女孩子说是男的。毫无掩饰的男男爱，让人无法直视。</p>
    <p>《DRAMAtical Murder》：原作是18禁BL GAME……比上面那部更无法直视。</p>
    <p></p>
    <p>萌系日常系。</p>
    <p>《花舞少女》：打画面牌的作品。虽然人设尽量跟原作，但是那个风格似乎不怎么适合动画，看起来不怎么顺眼，特别是那个棱形的眼睛，多用Q版弥补是个思路。上色和特效都下功夫了，画面看起来还算漂亮。</p>
    <p>《生存游戏社》：太田雅彦导演，信心保证。是时候教教G社做日常系的道理了。</p>
    <p>《人生》：原作没太大意思，动画也是一样，有种根本救不回来的感觉。卖萌、杀必死都尽力做了，还是很无力，是底子太差了吧。导演如果放开来用《萌单》的感觉来做反而会更有趣。</p>
    <p>《搞姬日常》：画个女孩子然后说是男的。</p>
    <p></p>
    <p>搞笑类，这个就不必多说了，都是续作，知道的都知道。</p>
    <p>《高达桑》：节操全无的无厘头搞笑作，很可惜只是短篇。</p>
    <p>《月刊少女野崎君》：得益于原作，相当有趣，会动的千代比漫画可爱！但是搞笑效果感觉比原作还是差了点，可能是看过原作造成的错觉？</p>
    <p></p>
    <p>偶像类。</p>
    <p>《Pripara》：继承《美妙旋律》系列新系列。基本上和《美妙旋律》没大差别。</p>
    <p>《少年好莱坞》：原作是小说，动画是原作者亲自执笔的新故事。虽然原作不算是女性向的作品，但是看起来还有有种基的感觉……</p>
    <p>《普通女高中生要做当地偶像》：其实更像是日常系轻喜剧。原作是四格漫画，动画有好好写了完整的故事，这点值得称赞。不过太淡了，内容也好画面表现也好，缺乏高潮，要说治愈系的话音乐也没做到位。属于偶尔看看感觉很不错，但是难有什么动力追的作品。</p>
    <p></p>
    <p>有技术革新意义的作品两部。</p>
    <p>《信长协奏曲》：富士电视台运用转描机技术自主之作的全CG动画。穿越题材，故事还算有意思，背景和特效的CG已经做得很不错了，可惜3D人物不另外微调果然效果还是不行。</p>
    <p>《见习女主角》：日本电视动画史上第一部“直播动画”！</p>
    <p></p>
    <p>故事向的作品。</p>
    <p>《恐怖余音》：暴恐题材的原创动画，第一集就讽刺公权机关兼炸了个大楼了，这个该不会变成禁片吧……</p>
    <p>《元气囝仔》：感觉不错，乡村清新悠哉的氛围营造得不错，果然是有《悠悠式》的成功经验在里面呢。不过本来是期待写书法的部分可以有比漫画更强的表现力的，可惜并没有眼前一亮的感觉。</p>
    <p></p>
    <p>部分续作。</p>
    <p>《Space Dandy2》：2期分割的后半，依然玩的很High！</p>
    <p>《Re：滨虎》：2期分割的后半，第一季留了个大悬念。本季岸诚二担纲当导演了。</p>
    <p>《女神异闻录4 黄金版》：故事内容上和《女神异闻录4》没什么区别，不过倒是全部重制了，战斗部分弄得比之前夸张了很多，而且加了香菜。重点果然还是香菜吧……</p>
    <p>《魔法少女伊利亚2wei》：小黑登场，不能再棒！</p>
    <p>《暗芝居2》：广受好评之后的第二季。本季找了几个恐怖电影导演来客串，可以期待更棒的内容。不过第一话看起来不怎么恐怖呢……</p>
    <p>《向山进发 第二季》：本季增长为15分钟两季度了，如果能有第三季有望变成30分钟一季度呢！</p>
    <p>《漫研部2》：出乎意料的第二季，依然是神经病式无厘头搞笑。</p>
    <p>《真Strange Plus》：同样没想到能有第二季，也是神经病式无厘头搞笑。不过本季导演换掉了，水准能不能保持呢。</p>

</div>

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
