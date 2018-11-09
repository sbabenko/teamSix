from django import template
from django.urls import reverse

register = template.Library()

@register.filter
@register.simple_tag
@register.tag
def navactive(request, urls):
    if request.path in ( reverse(url) for url in urls.split() ):
        return "active"
    return ""