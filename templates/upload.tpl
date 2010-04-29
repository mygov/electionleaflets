{include file="header.tpl"}
<div id="divContentFull">
    <form method="post" action="{$form_action}" >
        {include file="formvars.tpl"}    
        <h1>Step 1 - upload images</h1>
        <p>
            Take a photo of a each page of a <strong>single leaflet</strong> and upload it below in JPG format. If the leaflet was sent by mail, <em class="highlight2">please obscure  names and address with a marker pen</em>. If your image files are large (more than about 1MB), please resize to help keep our server happy, very large files may not upload.
        </p>
        <div>
    		<input type="file" name="uploadify" id="uploadify" />
    		<div id="divFileQue">
    		    <p class="hint">Your images will appear here</p>
    			<div id="imageList"></div>
    		</div>
        </div>
    	<br/>
    	<div class="buttons">
                {include file="formvars.tpl"}        			    
            	<input name="addInfo" type="submit" disabled="disabled"  value="Step 2 - add a few details &raquo;"/>
        </div>
    </form>        
</div>                
{include file="footer.tpl"}
