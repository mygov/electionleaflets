{literal}
    <style>

    	#straightchoice {
    		width:140px;
    		border-top: 10px solid;
    		padding-bottom: 15px;
    		padding-top: 4px;
    		border-top-color: rgb(214, 29, 0);
    		background:white;
    		font-size:12px;
    	}
    	
    	#straightchoice li {
    	    padding-left:0; margin-left:0;
    	    list-style-type:none;
	    }

	
    	#straightchoice .straightchoice_section {
		
    		border-top-style: dotted;
    		border-top-width: 1px;
    		padding: 3px 0px 6px 0px;
    		border-top-color: rgb(153, 153, 153);
		
    	}

    </style>
{/literal}
<div id="straightchoice">
    {if $has_leaflets}
        {if $method == 'constituency'}
            <h2>Latest campaign material near here</h2>
        {/if}
        {if $method == 'party'}
            <h2>Latest campaign material</h2>
        {/if}
        {if $method == 'latest'}
            <h2>Latest campaign material</h2>
        {/if}
        <p>
            from
            <br/>
            <a href="http://www.thestraightchoice.org">thestraightchoice.org</a>
        </p>
    {else}
        <h2>Have you received any election leaflets?</h2>    
    {/if}
    <ul class="results">
        {if $has_leaflets}
            {foreach from="$leaflets" item="leaflet"}
                <li {if $is_geo}class="has_distance"{/if} class="straightchoice_section">
                    <a class="leaflet" href="{$www_server}/leaflets/{$leaflet->leaflet_id}/">
						<img src="{image_url id=$leaflet->leaflet_image_image_key size=t}">
                        <!-- <img src="{$www_server}/image.php?i={$leaflet->leaflet_image_image_key}&amp;s=t"/> -->
                    </a>
                    <p>
                        {if $method != 'party'}
                            <a href="{$www_server}/parties/{$leaflet->party_url_id}/"><strong>{$leaflet->party_name}</strong>
                            </a>
                            uploaded {$leaflet->date_uploaded|date_format:"%A %e %B %Y"}
                        {else}
                            Uploaded {$leaflet->date_uploaded|date_format:"%A %e %B %Y"}
                        {/if}

                    </p>
                </li>
            {/foreach}
        {else}
            <li>
                <a class="leaflet" href="{$www_server}">
                    <img src="{$www_server}/images/country.jpg"/>
                </a>
            </li>
        {/if}
    </ul>
    <p class="straightchoice_section">
        <a href="{$www_server}/upload.php">Help The Straight Choice monitor the campaign by uploading material you receive</a>
    </p>
    {if $has_leaflets}
        <p class="straightchoice_section">
            {if $method == 'constituency'}
                <a href="{$www_server}/{$area_names}/{$leaflets[0]->constituency_url_id}/">More campaign material from this area</a>
            {/if}
            {if $method == 'party'}
                <a href="{$www_server}/parties/{$leaflets[0]->party_url_id}/">More campaign material for the party</a>
            {/if}
            {if $method == 'latest'}
                <a href="{$www_server}/leaflets.php">More latest campaign material</a>
            {/if}
        </p>
    {/if}
</div>
