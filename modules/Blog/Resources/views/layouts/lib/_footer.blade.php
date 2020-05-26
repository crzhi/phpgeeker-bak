<div class="f-weixin-dropdown">
    <div class="tooltip-weixin-inner">
        <h3>关注我们的公众号</h3>
        <div class="qcode">
            <img src="{{ asset($set->wechat_qrcode) }}" width="160" height="160" alt="微信公众号">
        </div>
    </div>
    <div class="close-weixin">
        <span class="close-top"></span>
        <span class="close-bottom"></span>
    </div>
</div>
<div id="footer" class="two-s-footer clearfix">
    <div class="footer-box">
        <div class="container">
            <div class="social-footer"></div>
            <div class="copyright-footer">
                <p>
                	Copyright &copy;个人笔记记录
					{{ strtoupper(config('phpgeeker.domain')) }}
					<a href="http://beian.miit.gov.cn" target="_blank">{{ config('phpgeeker.icp') }}</a>
             </p>
            </div>
            <div class="links-footer">
                <span>Powered By Laravel</span>
            </div>
        </div>
    </div>
</div>