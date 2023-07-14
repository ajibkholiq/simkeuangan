<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10" >
            <h2>{{ Request::segment(count(Request::segments()))}}</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">{{Request::segment(1)}}</a>
                    </li>
                </ol>
        </div>
</div>
