<?php
namespace LaraPlatform\Core\Builder;

interface IBuilder
{
    function Config();
    function BindData();
    function RenderHtml();
    function ToHtml();
}
