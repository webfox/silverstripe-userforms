<select $AttributesHTML <% if $RightTitle %>aria-describedby="{$Name}_right_title"<% end_if %>>
    <% loop $Options %>
        <% if $First && $Up.HasEmptyDefault %>
            <option value=""<% if $Selected %> selected="selected"<% end_if %> disabled>$Title.XML</option>
        <% else %>
            <option value="$Value.XML"<% if $Selected %> selected="selected"<% end_if %><% if $Disabled %> disabled="disabled"<% end_if %>>$Title.XML</option>
        <% end_if %>
    <% end_loop %>
</select>
